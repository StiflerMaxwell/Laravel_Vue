<?php

namespace App\Http\Controllers;
 
use App\Post;
use Illuminate\Http\Request;
use Facades\App\Repository\Posts;


class PostController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::get();
        return response()->json($posts);
         
    }
}
