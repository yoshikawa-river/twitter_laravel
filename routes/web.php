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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('in');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'home'])->name('home');
    Route::get('/post', [App\Http\Controllers\HomeController::class, 'post'])->name('post');
    Route::post('/store', [App\Http\Controllers\HomeController::class, 'store'])->name('store');
    Route::get('/mypage', [App\Http\Controllers\HomeController::class, 'mypage'])->name('mypage');
    // 投稿idが送られる
    // Route::get('/home/like/{id}',[App\Http\Controllers\HomeController::class, 'like'])->name('like');
    // Route::get('/home/nolike/{id}',[App\Http\Controllers\HomeController::class, 'nolike'])->name('nolike');

    Route::get('home/like/{post}', [App\Http\Controllers\goodController::class, 'like'])->name('like');
    Route::get('home/nolike/{post}', [App\Http\Controllers\goodController::class, 'nolike'])->name('nolike');

});