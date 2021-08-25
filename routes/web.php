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
    Route::get('/mylike', [App\Http\Controllers\HomeController::class, 'mylike'])->name('mylike');
    Route::get('/myreply', [App\Http\Controllers\HomeController::class, 'myreply'])->name('myreply');
    Route::get('/mypage', [App\Http\Controllers\HomeController::class, 'mypage'])->name('mypage');
    Route::post('/prof_up', [App\Http\Controllers\HomeController::class, 'prof_up'])->name('prof_up');
    Route::get('/edti_prof', [App\Http\Controllers\HomeController::class, 'edit_prof'])->name('edit_prof');

    
    
    Route::get('/user_all', [App\Http\Controllers\HomeController::class, 'user_all'])->name('user_all');
    Route::get('/post', [App\Http\Controllers\HomeController::class, 'post'])->name('post');
    Route::post('/store', [App\Http\Controllers\HomeController::class, 'store'])->name('store');
    Route::get('/user_page/{post}', [App\Http\Controllers\HomeController::class, 'user_page'])->name('user_page');
    Route::get('/serch_screen', [App\Http\Controllers\HomeController::class, 'serch_screen'])->name('serch_screen');
    Route::get('/serch', [App\Http\Controllers\HomeController::class, 'serch'])->name('serch');
    Route::get('home/like/{post}', [App\Http\Controllers\goodController::class, 'like'])->name('like');
    Route::get('home/nolike/{post}', [App\Http\Controllers\goodController::class, 'nolike'])->name('nolike');
    Route::get('/reply_page/{id}', [App\Http\Controllers\HomeController::class, 'reply_page'])->name('reply_page');
    Route::post('reply_page/reply/{id}', [App\Http\Controllers\HomeController::class, 'reply'])->name('reply');
    Route::get('/edit/{id}', [App\Http\Controllers\HomeController::class, 'edit'])->name('edit');
    Route::post('/update/{id}', [App\Http\Controllers\HomeController::class, 'update'])->name('update');
    Route::post('/delete/{id}', [App\Http\Controllers\HomeController::class, 'delete'])->name('delete');

    // Route::get('reply_page/like/{reply}', [App\Http\Controllers\goodController::class, 'reply_like'])->name('reply_like');
    // Route::get('reply_page/nolike/{reply}', [App\Http\Controllers\goodController::class, 'reply_nolike'])->name('reply_nolike');
});