<?php


use App\Events\TestTwo;
use App\Http\Controllers\Api\V1\Auth\VerificationController;
use App\Http\Controllers\Api\V1\FrontController;
use App\Http\Controllers\Api\V1\IndexController;
use App\Http\Controllers\Api\V1\profile\ArticleController;
use App\Http\Controllers\Api\V1\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Jobs\ProcessCreateArticle;
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

Route::group(
    ['prefix' => 'v1'],
    function () {
        // Тестовые события
        Route::get(
            '/redis',
            function (Request $request) {
                $redis = new Redis();
                $redis->connect('127.0.0.1', 6379);
                $redis->set('key', 188);
                $val = $redis->get('key');
                //dd($val);
            }
        );
        Route::get(
            '/event_one',
            function (Request $request) {
                //ProcessCreateArticle::dispatch();
                $userId = $request->get('user') ?? 2;
                $userObj = User::find($userId);
                ProcessCreateArticle::dispatch($userObj);
            }
        );
        Route::get(
            '/event_two',
            function (Request $request) {
                $userId = $request->get('user') ?? 2;
                $userObj = User::find($userId);
                TestTwo::dispatch($userObj->toArray());
            }
        );


        Route::post(
            '/test_user',
            [AuthController::class, 'me']
        );


        Route::get('/articles', [ArticleController::class, 'index'])->name('profile-articles2');
        Route::get('/articles/{id}', [ArticleController::class, 'show']);


        Route::get('/user', [AuthController::class, 'me'])->middleware(['auth.role']);
        Route::post('/user1', [AuthController::class, 'me'])->middleware(['auth.role']);


        // Публичные ройты
        Route::get('/posts', [FrontController::class, 'index'])->name('main');
        Route::get('/categories/{slug?}', [FrontController::class, 'category'])->name('category');
        Route::get('/menu', [MenusController::class, 'frontMenu'])->name('frontMenu');


        Route::middleware('throttle:1,1')->group(
            function () {
                Route::get(
                    '/products',
                    function () {
                        return 'its ok';
                    }
                );
            }
        );


        /*
         | -------------------------
         |  Авторизацуия Регистрация пользователя
         | ------------------------
         */


        // Новые
        Route::get('email/verify/{id}', [VerificationController::class, 'verify'])->name(
            'verification.verify'
        ); // Make sure to keep this as your route name
        Route::post('email/resend', [VerificationController::class, 'resend'])->name('verification.resend');

        // В API не используется реализуется на фронте
        Route::post('email/verify', [VerificationController::class, 'show'])->middleware(['throttle:6,1', 'auth.role'])->name(
            'verification.notice'
        );
        // Конец Новые


        Route::group(
            ['prefix' => 'profile', 'namespace' => 'profile', 'middleware' => ['auth.role']],
            function () {

                // Выйти
                Route::post('logout', [AuthController::class, 'logout'])->name('logout');
                Route::get('/user', [AuthController::class, 'me'])->middleware(['auth.role']);

                // Роут создания объявления
                Route::post('/articles', [ArticleController::class, 'store']);
                Route::get('/articles', [ArticleController::class, 'index'])->name('profile-articles');
                Route::get('/articles/{id}', [ArticleController::class, 'show'])->name('profile-show');

                // Создание коммента
                Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
            }
        );

        // создаём пользователя
        Route::post('register', [AuthController::class, 'register'])->name('store');
        Route::post('login', [AuthController::class, 'newLogin'])->name('login');


        Route::get('check', [AuthController::class, 'checkRoles'])->middleware(
            ['auth:sanctum', 'ability:server-updateww']
        );
        Route::post('users_roles', [AuthController::class, 'setRole'])->name('setRole');
        /*
        | -------------------------
        |  Конец Авторизацуия Регистрация пользователя
        | ------------------------
        */
    }
);
