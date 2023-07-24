<?php

namespace App\Http\Controllers\Admin\Post;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class DeleteController extends BaseController
{
    public function __invoke(Post $post)
    {
        $post->delete();
        $post->tags()->detach();
        Storage::disk('public')->delete($post->preview_image);
        Storage::disk('public')->delete($post->main_image);
        return redirect()->route('admin.post.index');
    }
}
