<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\PostCollection;
use App\Http\Resources\PostResource;
use App\Http\Resources\V1\ArticleCollection;
use App\Http\Resources\V1\ArticleResource;
use App\Models\Article;
use App\Models\Category;
use App\Models\Post;
use App\Repositories\TagRepository;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Cache;
use PHPUnit\Framework\MockObject\Stub\ReturnReference;

class FrontController extends Controller
{

    use ApiResponseTrait;

    public function index(Request  $request)
    {
      $ads = new PostCollection(Post::paginate(5), 'ads-front');
      //  $ads =  Post::paginate(5)->toArray();
      //  $cat = Category::where('parent_id', 0)->testMacro()->get();
//dd(env('APP_URL'));


        $banner = [
            'type' => 'banner',
            'list' => [
                'images' => [
                    'desc' => env('APP_URL').'/storage/images/hero/hero.jpg',
                    'mob' => env('APP_URL'). '/storage/images/hero/hero_mob.png',
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

    public function category($slug, Request $request): \Illuminate\Http\JsonResponse
    {
        $category = Category::where('slug', $slug)->first();

        if (!$category) {
            $this->errorResponse('', 404);
        }
       $articles = $category->articles()->paginate(3)->appends($request->query());

        return $this->successResponse(
            [
                'posts' => ArticleResource::collection($articles)->response()->getData(true),
                'category' => (new  CategoryResource($category)),
                'meta' => 'hello'
            ],
            'good',
            200
        );
    }



    public function show(Post $post): PostResource
    {
        $gg = '';
        return new PostResource($post);
    }

    public function store(Request $request)
    {
        $post = Post::create($request->all());
        return response($post);
    }


}
