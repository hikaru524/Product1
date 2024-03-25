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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//一覧画面
Route::get('/list', [App\Http\Controllers\ProductController::class, 'list'])->name('list');
//新規登録画面表示
Route::get('/create', [App\Http\Controllers\ProductController::class, 'createShow'])->name('create.show');
//新規登録画面入力
Route::post('/create', [App\Http\Controllers\ProductController::class, 'create'])->name('create');
