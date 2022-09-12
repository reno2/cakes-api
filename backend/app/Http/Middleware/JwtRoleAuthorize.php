<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;


class JwtRoleAuthorize extends BaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  mixed  ...$roles
     * @return JsonResponse
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        try {
            //Access token from the request
            $token = JWTAuth::parseToken();
            //Try authenticating user

            $user = $token->authenticate();
        } catch (TokenExpiredException $e) {
            //Thrown if token has expired
            return $this->unauthorized('Your token has expired. Please, login again.');
        } catch (TokenInvalidException $e) {
            //Thrown if token invalid
            return $this->unauthorized('Your token is invalid. Please, login again.');
        }catch (JWTException $e) {
            //Thrown if token was not found in the request.
            return $this->unauthorized('Please, attach a Bearer Token to your request');
        }

        if(!$roles){
            return $next($request);
        }
        // Получаем массив ролей пользователя
        $userRoles = $user->roles()->pluck('name')->toArray();

        // Проверяем вхождение ролей пользователя в требования middleware
        if (!!array_intersect($userRoles, $roles)) {
            return $next($request);
        }

        return $this->unauthorized();
    }

    private function unauthorized($message = null): JsonResponse
    {
        return response()->json([
                                    'message' => $message ? $message : 'You are unauthorized to access this resource',
                                    'success' => false
                                ], 401);
    }
}
