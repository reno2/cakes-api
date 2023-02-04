<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use App\Traits\ApiResponseTrait;
use Illuminate\Foundation\Auth\RedirectsUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\UserResource;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Log;

class VerificationController extends Controller
{
    use ApiResponseTrait, RedirectsUsers;

    /**
     * Show the email verification notice.
     *
     * @param  Request  $request
     * @return JsonResponse
     */
    public function show(Request $request)
    {
         if($request->user()->hasVerifiedEmail()){
             return $this->successResponse(route('profile-articles'), 'Redirect to home page', 301);
         }
        return $this->successResponse('ok', 'Need confirm email', 200);
    }



    public function verify($user_id, Request $request): JsonResponse
    {


        if (!$request->hasValidSignature()) {

            return response()->json(["msg" => "Invalid/Expired url provided."], 401);
        }

        $user = User::findOrFail($user_id);



        if (!$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
        }

        return $this->successResponse('ok', 'Email confirm', 200);
    }

    /**
     * Resend the email verification notification.
     *
     * @return JsonResponse|RedirectResponse
     */
    public function resend(Request $request): JsonResponse
    {


        //return $this->errorResponse($res , 429);

        if ($request->user()->hasVerifiedEmail()) {
            return response()->json(["msg" => "Email already verified."], 400);
        }

        $request->user()->sendEmailVerificationNotification();

        return response()->json(["msg" => "Email verification link sent on your email id"]);
    }


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }
}
