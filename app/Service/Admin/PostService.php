<?php


namespace App\Service\Admin;


use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PostService
{
    public function store($data)
    {
        try {
            DB::beginTransaction();

            if (isset($data['tag_ids'])) {
                $tag_ids = $data['tag_ids'];
                unset($data['tag_ids']);
            }
            if (isset($data['preview_image'])) {
                $data['preview_image'] = Storage::disk('public')->put('/images', $data['preview_image']);
            }
            if (isset($data['main_image'])) {
                $data['main_image'] = Storage::disk('public')->put('/images', $data['main_image']);
            }

            $post = Post::firstOrCreate($data);

            if (isset($data['tag_ids'])) {
                $post->tags()->attach($tag_ids);
            }

            DB::commit();
        } catch (\Exception) {
            DB::rollBack();
            abort(500);
        }
    }

    public function update($data, $post)
    {
        try {
            DB::beginTransaction();

            if (isset($data['tag_ids'])) {
                $tag_ids = $data['tag_ids'];
                unset($data['tag_ids']);
            }
            if(isset($data['preview_image'])) {
                Storage::disk('public')->delete($post->preview_image);
                $data['preview_image'] = Storage::disk('public')->put('/images', $data['preview_image']);
            }
            if(isset($data['main_image'])) {
                Storage::disk('public')->delete($post->main_image);
                $data['main_image'] = Storage::disk('public')->put('/images', $data['main_image']);
            }

            $post->update($data);

            if (isset($tag_ids)) {
                $post->tags()->sync($tag_ids);
            } else {
                $post->tags()->detach();
            }

            DB::commit();
            return $post;
        } catch (\Exception) {
            DB::rollBack();
            abort(500);
        }
    }
}
