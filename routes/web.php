<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ParserController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\UserController;
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
Route::get('/', [HomeController::class, 'index'])
    ->name('main');


Route::group([
    'prefix' => 'news',
    'as' => 'news::'
],
    function () {
        Route::get('/', [NewsController::class, 'index'])
            ->name('index');

        Route::get('/{news}', [NewsController::class, 'getNews'])
            ->whereNumber('news')
            ->name('news');

        Route::get('/categories', [NewsController::class, 'getCategories'])
            ->name('categories');

        Route::get('/categories/{category}', [NewsController::class, 'getCategory'])
            ->whereNumber('category')
            ->name('category');
    });


Route::middleware(['auth', 'moder'])
    ->prefix('admin')
    ->group(function () {
        Route::get('/', [AdminController::class, 'index']);

        Route::get('/news/add/', [AdminController::class, 'addNews']);

        Route::post('/save', [AdminController::class, 'saveNews']);

        Route::get('/category', [AdminController::class, 'category'])
            ->middleware('admin');

        Route::post('/saveCat', [AdminController::class, 'saveCategory'])
            ->middleware('admin');

        Route::get('delCategory/{category}/{type?}', [AdminController::class, 'delCategory'])
            ->middleware('admin');

        Route::get('delNews/{news}/{type?}', [AdminController::class, 'delNews']);

        Route::get('restore/{delNews}', [AdminController::class, 'restore']);

        Route::get('restoreCategory/{delCategory}', [AdminController::class, 'restoreCategory'])
            ->middleware('admin');

        Route::get('edit/{news}', [AdminController::class, 'editNews']);

        Route::post('edit/{news}', [AdminController::class, 'saveEditNews']);

        Route::get('publish/{news}/{status?}', [AdminController::class, 'publish']);

        Route::get('users', [AdminController::class, 'getUsers'])
            ->name('users');

        Route::post('saveUser/{user}', [AdminController::class, 'saveUser'])
            ->middleware('user-access');

        Route::post('savePass/{user}', [AdminController::class, 'saveUserPassword']);

        Route::get('delUser/{user}', [AdminController::class, 'delUser']);

        Route::get('parser/{name}', [ParserController::class, 'initParser'])
            ->name('parser');
});

Route::get( '/login', [LoginController::class, 'login'])
    ->name('login');

Route::post('/login', [LoginController::class, 'loginForm']);

Route::get('login/social/{name}', [SocialController::class, 'indexLogin']);

Route::get('social/{name}', [SocialController::class, 'redirect']);

Route::get('/logout', [LoginController::class, 'logout']);

Route::get( '/registration', [LoginController::class, 'registration']);

Route::post( '/registration', [LoginController::class, 'regForm']);

Route::get('/user/{user?}', [UserController::class, 'index'])
    ->name('user')
    ->middleware('auth');

Route::get('/about', function () {
    return view('about');
});

Route::get('/locale/{lang}', [UserController::class, 'setUserLocale']);

