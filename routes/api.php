<?php

use Illuminate\Http\Request;

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

Route::get('videos', 'VideoController@index');
Route::patch('videos/view/{id}', 'VideoController@view');



Route::get('views', 'ViewController@index')->middleware('jwt');

// User
Route::post('register', 'UserController@create')->middleware('jwt');
Route::get('login', 'UserController@show')->middleware('jwt');
Route::patch('updatePicture', 'UserController@update')->middleware('jwt');