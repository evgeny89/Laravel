<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
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

    Route::get('/add', function () {
        return view('news.add');
    });

    Route::post('/save', [NewsController::class, 'saveNews']);
});

Route::get('/about', function () {
   return view('about') ;
});

Route::get('/auth', function () {
    return view('login');
});

