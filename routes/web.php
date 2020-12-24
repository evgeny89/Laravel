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

    Route::get('/category/{num}', [NewsController::class, 'getCategory'])
        ->whereNumber('num');
});


Route::group([
   'prefix' => 'admin'
],
function() {
    Route::get('/', [AdminController::class, 'index']);

    Route::get('/news/add', [AdminController::class, 'addNews']);

    Route::post('/save', [AdminController::class, 'saveNews']);

    Route::get('/category/add', [AdminController::class, 'addCategory']);

    Route::post('/saveCat', [AdminController::class, 'saveCategory']);
});

Route::match(['GET', 'POST'], '/auth', [UserController::class, 'login']);

Route::get('/user/{name?}', [UserController::class, 'index'])
    ->name('user');

Route::get('/about', function () {
    return view('about');
});

