<?php

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
    return view('welcome');
});

Route::get('news/{num?}', function ($num = 1) {
    return view('news', ['num' => $num]);
});

Route::get('/user/{name?}', function ($name = 'Guest') {
    return view('user', ['name' => $name]);
})->whereAlphaNumeric('name');

Route::get('/info', function () {
    return view('info');
});
