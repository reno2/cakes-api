<?php


use App\Http\Controllers\Api\V1\FrontController;
use App\Http\Controllers\Api\V1\IndexController;
use App\Http\Controllers\Api\V1\profile\ArticleController;
use App\Http\Controllers\Api\V1\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\PostController;
use App\Http\Controllers\Api\V1\MenusController;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\profile\CommentController;
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



//Route::post('/login', [AuthController::class, 'newLogin']);

Route::group(['prefix'=>'v1'], function() {


//    Route::apiResources([
//        'posts' => PostController::class,
//    ]);

  Route::get('/user', [AuthController::class, 'me'])->middleware(['auth.role']);
  Route::post('/user1', [AuthController::class, 'me'])->middleware(['auth.role']);
//
//    Route::get('/test', function(){
//        $user = User::find(1);
//        $ar = $user->roles()->pluck('name')->toArray();
//        $ar2 = ['admin1', 'editor'];
//     //
//       dd(!!array_intersect( $ar, $ar2));
//    });

    //Route::post('/posts', [ArticleController::class, 'store']);

    //Route::get('/posts', [FrontController::class, 'index'])->name('main');



//    Route::get('/img', function(){
//        dd( Storage::url('/images/hero/hero_bg.png'));
//        //Storage::disk('public')->put('text.txt', 'hi');
//    });



    // Публичные ройты
    Route::get('/posts', [FrontController::class, 'index'])->name('main');
    Route::get('/categories/{slug?}', [FrontController::class, 'category'])->name('category');
    Route::get('/menu', [MenusController::class, 'frontMenu'])->name('frontMenu');

    // Пользователь авторизован
    Route::group(['prefix' => 'profile', 'namespace' => 'profile', 'middleware' => ['auth.role']], function() {

        // Выйти
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('/user', [AuthController::class, 'me'])->middleware(['auth.role']);

        // Роут создания объявления
        Route::post('/article', [ArticleController::class, 'store']);
        Route::get('/articles', [ArticleController::class, 'index'])->name('profile-articles');

        // Создание коммента
        Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
    });

    // создаём пользователя
   Route::post('register', [AuthController::class, 'register'])->name('store');
   Route::post('login', [AuthController::class, 'newLogin'])->name('login');


    Route::get('check', [AuthController::class, 'checkRoles'])->middleware(['auth:sanctum', 'ability:server-updateww']);
    Route::post('users_roles',  [AuthController::class, 'setRole'])->name('setRole');
});
