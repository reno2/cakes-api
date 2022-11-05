<?php

namespace App\Http\Controllers\Api\V1\profile;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Http\Requests\CommentsRequest;
use App\Repositories\AdsRepository;
use App\Repositories\CommentsRepository;


class CommentController extends Controller
{


    protected $profileRepository;
    protected $adsRepository;
    protected $commentsRepository;

    public function __construct (
        CommentsRepository $commentsRepository,
        //ProfileRepository $profileRepository,
        AdsRepository $adsRepository
    ) {
       // $this->profileRepository = $profileRepository;
        $this->adsRepository = $adsRepository;
        $this->commentsRepository = $commentsRepository;
    }


    /**
     * Добавляет комментарий с фронта
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store (CommentsRequest $request) {



        $request->validated();
        $request = $request->toArray();
        //return response()->json(array ('success' => true, 'msg' => 'Ваш вопрос отправлен'), 200);


        $adsAuthor = \DB::table('articles')
            ->select('user_id')
            ->where('id', $request['article_id'])
            ->first();

        try{
            $newComment = $this->commentsRepository->create($request);
            return response()->json(array ('success' => true, 'msg' => 'Ваш вопрос отправлен'), 200);
        } catch (\Exception  $e) {
            //Log::debug($e->getMessage());
            return response()->json(array ('success' => false, 'msg' => $e->getMessage()), 200);
        }
    }
}
