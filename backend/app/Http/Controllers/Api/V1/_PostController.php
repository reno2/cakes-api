<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Http\Requests\StorePostRequest;
use App\Jobs\PostCreated;
use App\Models\Post;
use http\Env\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\PostResource;
use App\Http\Resources\PostCollection;
use App\Http\Resources\CategoryResource;
use mysql_xdevapi\Exception;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new PostCollection(Post::with('category')->paginate(50));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StorePostRequest $request
     * @return \App\Http\Resources\PostResource
     */
    public function store(StorePostRequest $request)
    {
        $post = Post::create($request->validated());
        PostCreated::dispatch($post->toArray());
        return new PostResource($post);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse|PostResource
     */
    public function show(int $id)
    {
        $post = Post::find($id);
        if ($post) {
            return new PostResource($post->load('category'));
        }
        return response()->json(['message' => 'Not Found!'], 404);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\StorePostRequest $request
     * @param Post $post
     * @return PostResource
     */
    public function update(StorePostRequest $request, Post $post)
    {
        $post->update($request->validated());
        return new PostResource($post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->category()->dissociate();
        $post->comments()->detach();
        $post->delete();
        return response()->noContent();
    }


    public function postsCategories(Post $post)
    {
        return $post->category;
    }
}
