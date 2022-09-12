<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostCollection;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Repositories\TagRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Cache;
use PHPUnit\Framework\MockObject\Stub\ReturnReference;

class FrontController extends Controller
{
    public function index()
    {
        $ads = new PostCollection(Post::paginate(5), 'ads-front');


        $banner = [
            'type' => 'banner',
            'list' => [
                'images' => [
                    'desc' => asset('storage/images/hero/hero.jpg'),
                    'mob' => asset('storage/images/hero/hero_mob.png'),
                ],
                'title' => 'Найди своего кондитера с 2CAKE',
                'desc' => 'Господа, высокотехнологичная концепция общественного уклада',
                'links' => [
                    'order' => 'Заказать десерт',
                    'reg' => 'Я кондитер',
                ]
            ]
        ];

        $seo = ['title' => 'Главная', 'description' => 'Это главная страница'];

        return response()->json(
            [
                'errors' => null,
                'sections' => [
                    $ads,
                    $banner,
                ],
                'seo' => $seo
            ],
            200
        );
    }


    public function show(Post $post): PostResource
    {
        return new PostResource($post);
    }

    public function store(Request $request)
    {
        $post = Post::create($request->all());
        return response($post);
    }


}
