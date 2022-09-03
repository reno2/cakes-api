<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\IndexController;
use App\Http\Controllers\Api\V1\UserController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\PostController;
use App\Http\Controllers\Api\V1\MenusController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//Auth::routes();
Route::group(['prefix'=>'v1'], function() {

    Route::apiResources([
        'posts' => PostController::class,
    ]);


    Route::get('/menu', [MenusController::class, 'frontMenu'])->name('frontMenu');

    Route::group(['middleware' => 'auth:api'], function() {
        Route::get('user', [AuthController::class, 'me'])->name('user');
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    });

    Route::post('register', [AuthController::class, 'store'])->name('store');
    Route::post('login', [AuthController::class, 'newLogin'])->name('login');


    Route::get('check', [AuthController::class, 'checkRoles'])->middleware(['auth:sanctum', 'ability:server-updateww']);
    Route::post('users_roles',  [AuthController::class, 'setRole'])->name('setRole');
});
