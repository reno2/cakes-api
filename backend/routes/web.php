<?php

use App\Http\Controllers\Api\V1\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $rr = '';
    //xdebug_info();
});
//    //$categories = \App\Models\Category::all();
//    $posts = \App\Models\Post::with('comments')->get()->toArray();
//
//    dd($posts);
//    foreach($posts as $post){
//
//    }
//
//    return view('welcome');
//});

//Auth::routes();
//Route::post('login', [AuthController::class, 'login'])->name('login_web');
//Route::post('users', [AuthController::class, 'store']);
//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});
//Route::post('login', [AuthController::class, 'login']);
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
