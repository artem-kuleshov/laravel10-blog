<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Carbon\Carbon;

class ShowController extends Controller
{
    public function __invoke(Post $post)
    {
        $date_created = Carbon::parse($post->created_at);
        $related_posts = Post::where('category_id', $post->category_id)->where('id', '!=', $post->id)->get()->take(3);

        $post = Post::with('comments.user')->where('id', $post->id)->first();

        return view('post.show', compact('post', 'date_created', 'related_posts'));
    }
}
