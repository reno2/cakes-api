<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\IndexController;
use App\Http\Controllers\Api\V1\UserController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\PostController;
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

    Route::get('/posts', [IndexController::class, 'index'])->name('index');

//Route::group(['middleware' => 'auth:sanctum'], function() {
//    Route::get('/posts', [IndexController::class, 'index'])->name('index');
//});
//Route::get('/posts/{post}', [IndexController::class, 'show'])->name('show');

//Route::post('/posts', [IndexController::class, 'store'])->name('store');

//Route::get('/posts', [IndexController::class, 'all'])->name('all');

//Route::group(['middleware' => 'auth:sanctum'], function(){
//    Route::get('/', function(){
//        return 'Hello';
//    });
//
//});
   // Route::get('/user', [AuthController::class, 'me']);
    //Route::get('user', [AuthController::class, 'me'])->middleware('auth:sanctum');
//   Route::post('login', [AuthController::class, 'login'])->name('login');
//   Route::post('users', [AuthController::class, 'store']);


//Route::apiResources([
//    'posts' => PostController::class
//]);
//Route::get('/posts/{post}/categories', [PostController::class, 'postsCategories']);
//
    Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
        return $request->user();
    });
    Route::get('check', [AuthController::class, 'checkRoles'])->middleware(['auth:sanctum', 'ability:server-updateww', 'is_admin']);
  //Route::middleware(['auth:sanctum' => 'ability:server-update'])->get('/check', [AuthController::class, 'checkRoles']);
    //   Route::middleware('auth:sanctum')->get('/check', [AuthController::class, 'checkRoles']);

        //->name('checkRoles');

//    Route::middleware('auth:sanctum')->get('/check', function (Request $request) {
//        return $request->user();
//    });
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('login', [AuthController::class, 'login'])->name('login');

    Route::post('users_roles',  [AuthController::class, 'setRole'])->name('setRole');
});
