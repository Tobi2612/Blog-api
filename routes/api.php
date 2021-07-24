<?php

use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

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


Route::group(['middleware' => 'api','prefix' => 'auth'], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
    Route::post('register', 'AuthController@register');

});


Route::group(['prefix' => 'posts'],function(){
    Route::post('add',[PostController::class,'add']);
    Route::post('update',[PostController::class,'update']);
    Route::post('remove/{post_id}',[PostController::class,'remove']);
    Route::get('/{post_id}',[PostController::class,'show']);
    Route::get('',[PostController::class,'index']);
    Route::post('/comment',[PostController::class,'addComment']);
});

