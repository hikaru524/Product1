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

Route::get('/home', [App\Http\Controllers\ProductController::class, 'list'])->name('list');
//一覧画面-表示
Route::get('/list', [App\Http\Controllers\ProductController::class, 'list'])->name('list');
//一覧画面-削除
Route::post('/delete/{id}', [App\Http\Controllers\ProductController::class, 'destroy'])->name('product.delete');
//一覧画面-検索
Route::get('/search', [App\Http\Controllers\ProductController::class, 'search'])->name('search');
//一覧画面-ソート
Route::get('/sort', [App\Http\Controllers\ProductController::class, 'sort'])->name('sort');
//一覧画面-ページ
//Route::get('/list', [App\Http\Controllers\ProductController::class, 'page'])->name('page');

//新規登録画面-表示
Route::get('/create', [App\Http\Controllers\ProductController::class, 'createShow'])->name('create.show');
//新規登録画面-入力
Route::post('/create', [App\Http\Controllers\ProductController::class, 'create'])->name('create');

//商品詳細画面-表示
Route::get('/product/{id}', [App\Http\Controllers\ProductController::class, 'productshow'])->name('product.show');

//商品編集画面-表示
Route::get('/edit/{id}', [App\Http\Controllers\ProductController::class, 'productedit'])->name('product.edit');
//商品編集画面-更新
Route::put('/edit/{id}', [App\Http\Controllers\ProductController::class, 'productupdate'])->name('product.update');

//一覧画面-検索-ajax
Route::get('/list/{search}', 'ProductController@getProductBygetsearch');
