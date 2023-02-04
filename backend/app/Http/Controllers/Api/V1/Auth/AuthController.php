<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\UserResource;
use Illuminate\Auth\Events\Registered;

class AuthController extends Controller
{
    use ApiResponseTrait;
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     */
    protected function create(array $data)
    {
        $user = User::create(
            [
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]
        );
        if(!$user){
            $this->errorResponse($e->getMessage(), 401);
        }

        event(new Registered($user));

    }

}
