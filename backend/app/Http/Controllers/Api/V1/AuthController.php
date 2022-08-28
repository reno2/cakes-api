<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $creds = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'name' => 'nullable|string',
        ]);

        $user = User::where('email', $creds['email'])->first();
        if ($user) {
            return response(['error' => 1, 'message' => 'user already exists'], 409);
        }

        $user = User::create([
            'email' => $creds['email'],
            'password' => Hash::make($creds['password']),
            'name' => $creds['name'],
        ]);

        $defaultRoleSlug = config('hydra.default_user_role_slug', 'user');
        $user->roles()->attach(Role::where('slug', $defaultRoleSlug)->first());

        return $user;
    }


    /**
     * Authenticate an user and dispatch token.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request) {
        $creds = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $creds['email'])->first();

        //$plainTextToken = $user->createToken('hydra-api-token')->plainTextToken;
        $credentions = $request->only('email', 'password');

        if(!auth()->attempt($credentions)){
            return response(['error' => 1, 'message' => 'invalid credentials'], 401);
        }

        $roles = $user->roles->pluck('slug')->all();
        $plainTextToken = $user->createToken('token-permissions', ['server-update'])->plainTextToken;
        //$request->session()->regenerate();
        return response(['error' => 0, 'id' => $user->id, 'token' => $plainTextToken], 200);

//        $user = User::where('email', $creds['email'])->first();
//        if (! $user || ! Hash::check($request->password, $user->password)) {
//            return response(['error' => 1, 'message' => 'invalid credentials'], 401);
//        }
//
//        if (config('hydra.delete_previous_access_tokens_on_login', false)) {
//            $user->tokens()->delete();
//        }
//
//        $roles = $user->roles->pluck('slug')->all();
//
//        $plainTextToken = $user->createToken('hydra-api-token', $roles)->plainTextToken;
//        $request->session()->regenerate();
//

//        return response()->json([
//            'access_token' => $plainTextToken,
//            'token_type' => 'Bearer',
//        ]);
        //return response(['error' => 0, 'id' => $user->id, 'token' => $plainTextToken], 200);
    }

    public function me(Request $request) {
        return $request->user();
    }

    public function logout(Request $request){
        auth()->user()->tokens()->delete();
        return response(['error' => 0], 200);
    }
    public function setRole(Request $request){
//        $data = $request->validate([
//            'role_id' => 'required|integer',
//        ]);
        $user = User::find($request->id);
        $role = Role::find($request->role_id);
        if (!$user->roles()->find($request->role_id)) {
            $user->roles()->attach($role);
        }

        return $user->load('roles');
    }

    public function checkRoles(Request $request){
        $user = $request->user();

      //return $user->tokens()->delete();
        $tokens = [];
        foreach ($user->tokens as $token) {
            $tokens[] = $token;
        }
//return   $request->bearerToken();
       // $roles = $user->roles->pluck('slug')->all();
       return $tokens;
        if($user->tokenCan('Customer')) {
            return 'bad';
        }
        return 'rtrt';

    }
}
