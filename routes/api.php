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



Route::get('views', 'ViewController@index')->middleware('JWT');

// User
Route::post('register', 'UserController@store')->middleware('JWT');
Route::get('login', 'UserController@show')->middleware('JWT');
Route::patch('updatePicture', 'UserController@update')->middleware('JWT');

// Code
Route::post('getCode', 'ConnectionController@store')->middleware('optionalJWT');

// Categories
Route::get('categories', 'CategoryController@index');
Route::get('category/{id}', 'CategoryController@show');

// Videos
Route::get('videos/{id}', 'VideoController@show');
Route::patch('videos/{id}/view', 'VideoController@view')->middleware('JWT');
Route::patch('videos/{id}/complete', 'VideoController@complete')->middleware('JWT');

// Homepage
Route::get('home', 'VideoController@home')->middleware('optionalJWT');