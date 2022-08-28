<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostCollection;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use PHPUnit\Framework\MockObject\Stub\ReturnReference;

class IndexController extends Controller
{
    public function index()
    {
//        return new PostCollection(Cache::remember('posts_paginate', 60 * 60 * 24, function () {
//            Post::paginate(10);
//        }));

        return new PostCollection(Post::paginate(10));
    }


    public function show(Post $post): PostResource
    {
        return new PostResource($post);
    }

    public function store(Request $request){
        $post = Post::create($request->all());
        return response($post);
    }


}
