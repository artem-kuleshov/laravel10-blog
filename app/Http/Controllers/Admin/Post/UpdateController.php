<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Post\UpdateRequest;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, Post $post)
    {
        $data = $request->validated();
        $tag_ids = $data['tag_ids'];
        unset($data['tag_ids']);

        if( array_key_exists('preview_image',$data)) {
            Storage::disk('public')->delete($post->preview_image);
            $data['preview_image'] = Storage::disk('public')->put('/images', $data['preview_image']);
        }
        if( array_key_exists('main_image',$data)) {
            Storage::disk('public')->delete($post->main_image);
            $data['main_image'] = Storage::disk('public')->put('/images', $data['main_image']);
        }

        $post->update($data);
        $post->tags()->sync($tag_ids);

        return redirect()->route('admin.post.show', compact('post'));
    }
}
