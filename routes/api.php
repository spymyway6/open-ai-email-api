<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\ChatGPTController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Post Routes

Route::get('/posts', [PostController::class, 'index']);
Route::post('/posts/create', [PostController::class, 'store']);
Route::post('/chatgpt', [ChatGPTController::class, 'getResponse']);
