<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use app\Http\Controllers\SalesController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/list', function (Request $request) {
    return $request->product();
});

//API
Route::get('/purchase', [App\Http\Controllers\SalesController::class, 'purchase']);
Route::post('/purchase', [App\Http\Controllers\SalesController::class, 'purchase']);
//一覧画面-json送信
//API
Route::get('/jsonpage', [App\Http\Controllers\ProductController::class, 'jsonpage'])->name('jsonpage');
//Route::get('/jsonajax', [App\Http\Controllers\ProductController::class, 'jsonajax'])->name('jsonajax');

