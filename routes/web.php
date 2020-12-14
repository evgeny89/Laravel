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

Route::get('news', [NewsController::class, 'index']);

Route::get('news/{num}', [NewsController::class, 'getNews'])
    ->whereNumber('num');

Route::get('news/categories', [NewsController::class, 'getCategories']);

Route::get('news/category/{num}', [NewsController::class, 'getCategory'])
    ->whereNumber('num');

Route::get('/about', function () {
   return view('about', [
       'title' => 'О нас',
       'menu' => \App\Models\Data::getMenu()
   ]) ;
});

Route::get('/auth', function () {
    return view('login', [
        'title' => 'Log In',
        'menu' => \App\Models\Data::getMenu()
    ]);
});

