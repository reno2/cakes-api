<?php

namespace App\Http\Controllers\Api\V1\profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdsRequest;
use App\Http\Resources\V1\ArticleResource;
use App\Repositories\AdsRepository;
use App\Repositories\UserRepository;
use App\Services\AdsService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

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
        $userPosts = [];
        if($request->user()->id){
            $where = [
                ['user_id', $request->user()->id],
                ['moderate', '=', 1],
                ['published', '=', 1]
            ];
            $userPosts = $this->adsRepository->getByCurrentProfileAdsSortedDesc($where, 'ads');

        }
       return $this->successResponse(
           [
               'articles' => ArticleResource::collection($userPosts)->response()->getData(true)
            ],
           'Пост создан', 201);


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



        try{
            $this->adsService->chain($inputs);
            $this->successResponse([], 'Пост создан', 201);
        }catch (\Exception $e){
            $this->errorResponse( $e->getMessage(), 401);
        }
//
//        return response()->json(
//            [
//                'data' => $inputs
//            ],
//            200
//        );

//        $tt = '';
//        $validated = $request->validated();
//        $inputs = $request->all();
//        try{
//            $this->adsService->chain($inputs);
//            session()->flash('notice', "Объявление создано и отправлено на модерацию");
//        }catch (\Exception $e){
//            return back()->withErrors( $e->getMessage())->withInput();
//        }
//
//        return redirect()->to(route('profile.ads.index').'#moderate');
}

/**
 * Display the specified resource.
 *
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
public
function show($id)
{
    //
}

/**
 * Update the specified resource in storage.
 *
 * @param  Request  $request
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
public
function update(Request $request, $id)
{
    //
}

/**
 * Remove the specified resource from storage.
 *
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
public
function destroy($id)
{
    //
}
}
