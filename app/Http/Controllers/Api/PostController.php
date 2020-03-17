<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Post;

class PostController extends Controller
{
    public function posts()
    {
        $posts = Post::published()->get();

        return response()->json($posts);
    }
}
