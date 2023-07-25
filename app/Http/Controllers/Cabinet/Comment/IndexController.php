<?php

namespace App\Http\Controllers\Cabinet\Comment;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function __invoke()
    {
        $comments = auth()->user()->comments;
        return view('cabinet.comment.index', compact('comments'));
    }
}
