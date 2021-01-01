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
Route::get('/', [HomeController::class, 'index']);


Route::group([
    'prefix' => 'news'
],
function () {
    Route::get('/', [NewsController::class, 'index']);

    Route::get('/{num}', [NewsController::class, 'getNews'])
        ->whereNumber('num');

    Route::get('/categories', [NewsController::class, 'getCategories']);

    Route::get('/categories/{num}', [NewsController::class, 'getCategory'])
        ->whereNumber('num');
});


Route::group([
   'prefix' => 'admin'
],
function() {
    Route::get('/{msg?}', [AdminController::class, 'index']);

    Route::get('/news/add/{msg?}', [AdminController::class, 'addNews']);

    Route::post('/save', [AdminController::class, 'saveNews']);

    Route::get('/category/add', [AdminController::class, 'addCategory']);

    Route::post('/saveCat', [AdminController::class, 'saveCategory']);

    Route::get('delCategory/{id}/{type?}', [AdminController::class, 'delCategory']);

    Route::get('delNews/{id}/{type?}', [AdminController::class, 'delNews']);

    Route::get('restore/{id}', [AdminController::class, 'restore']);

    Route::get('edit/{id}', [AdminController::class, 'editNews']);

    Route::post('edit/{id}', [AdminController::class, 'saveEditNews']);

    Route::get('publish/{id}/{status?}', [AdminController::class, 'publish']);
});

Route::match(['GET', 'POST'], '/auth', [UserController::class, 'login']);

Route::get('/user/{name?}', [UserController::class, 'index'])
    ->name('user');

Route::get('/about', function () {
    return view('about');
});

