<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
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


Route::group([
    'prefix' => 'admin',
    'as' => 'admin::'
],
    function () {
        Route::get('/', [AdminController::class, 'index']);

        Route::get('/news/add/', [AdminController::class, 'addNews']);

        Route::post('/save', [AdminController::class, 'saveNews']);

        Route::get('/category', [AdminController::class, 'category']);

        Route::post('/saveCat', [AdminController::class, 'saveCategory']);

        Route::get('delCategory/{category}/{type?}', [AdminController::class, 'delCategory']);

        Route::get('delNews/{news}/{type?}', [AdminController::class, 'delNews']);

        Route::get('restore/{delNews}', [AdminController::class, 'restore']);

        Route::get('restoreCategory/{delCategory}', [AdminController::class, 'restoreCategory']);

        Route::get('edit/{news}', [AdminController::class, 'editNews']);

        Route::post('edit/{news}', [AdminController::class, 'saveEditNews']);

        Route::get('publish/{news}/{status?}', [AdminController::class, 'publish']);
    });

Route::match(['GET', 'POST'], '/login', [UserController::class, 'login']);

Route::get('/logout', [UserController::class, 'logout']);

Route::get('/user/{user}', [UserController::class, 'index'])
    ->name('user');

Route::get('/about', function () {
    return view('about');
});

