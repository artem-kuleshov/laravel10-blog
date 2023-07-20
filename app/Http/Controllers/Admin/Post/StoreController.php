<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Post\StoreRequest;
use App\Models\post;
use Illuminate\Support\Facades\Storage;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();
        $tag_ids = $data['tag_ids'];
        unset($data['tag_ids']);

        $data['preview_image'] = Storage::disk('public')->put('/images', $data['preview_image']);
        $data['main_image'] = Storage::disk('public')->put('/images', $data['main_image']);

        $post = Post::firstOrCreate($data);
        $post->tags()->attach($tag_ids);

        return redirect()->route('admin.post.index');
    }
}
