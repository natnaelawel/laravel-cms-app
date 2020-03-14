<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    //
    public function show(Post $post){
        return view('blog.show')->with('post', $post);
    }
}
