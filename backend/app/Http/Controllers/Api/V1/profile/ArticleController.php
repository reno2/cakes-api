<?php

namespace App\Http\Controllers\Api\V1\profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdsRequest;
use App\Http\Resources\V1\ArticleCollection;
use App\Http\Resources\V1\ArticleResource;
use App\Models\Article;
use App\Repositories\AdsRepository;
use App\Repositories\UserRepository;
use App\Services\AdsService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

use function Psy\debug;

class ArticleController extends Controller
{
    use ApiResponseTrait;

    protected $adsService;
    protected $adsRepository;


    public function __construct(AdsService $adsService, AdsRepository $adsRepository)
    {
        // $this->middleware('preventBackHistory');
        $this->adsService = $adsService;
        $this->adsRepository = $adsRepository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        $userId = $request->user()->id;
        $perPage = $request->get('perPage') ?? 10;
        $userPosts = [];

        $userPosts = $this->adsRepository->getByCurrentProfileAdsSortedDesc(null, 'ads', $userId, $perPage);
        $userPosts = ArticleResource::collection($userPosts)
            ->setPagIde('ads')
            ->setTpl('profile-ads-list')
            ->response()->getData(true);

        $seo = ['title' => 'Профиль пользователя', 'description' => 'Это страница пользователя'];

        return $this->successResponse(
            [
                'sections' => [$userPosts],
                'seo' => $seo
            ],
            '',
            200
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  AdsRequest  $request
     * @return JsonResponse
     */
    public function store(AdsRequest $request)
    {
        $inputs = $request->all();


        try {
            $this->adsService->chain($inputs);
            $this->successResponse([], 'Пост создан', 201);
        } catch (\Exception $e) {
            $this->errorResponse($e->getMessage(), 401);
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function show($id)
    {
        try {
            $article = Article::findOrFail($id);
            $articleResource = new ArticleResource($article);
           return $this->successResponse(
               $articleResource, 'good', 200);
        }catch (\Exception $e) {
            $this->errorResponse($e->getMessage(), 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public
    function update(
        Request $request,
        $id
    ) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public
    function destroy(
        $id
    ) {
        //
    }
}
