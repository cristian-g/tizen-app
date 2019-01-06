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
Route::get('categories', 'CategoryController@index')->middleware('optionalJWT');
Route::get('category/{id}', 'CategoryController@show')->middleware('optionalJWT');

// Videos
Route::get('videos/{id}', 'VideoController@show')->middleware('optionalJWT');
Route::patch('videos/{id}/view', 'VideoController@view')->middleware('JWT');
Route::patch('videos/{id}/complete', 'VideoController@complete')->middleware('JWT');

// Homepage
Route::get('home', 'VideoController@home')->middleware('optionalJWT');

// Purchase
Route::post('purchase', 'PurchaseController@store')->middleware('JWT');

// Contacts
Route::get('contacts', 'UserController@index')->middleware('JWT');

// Recommendation
Route::post('recommendation', 'RecommendationController@store')->middleware('JWT');

// Notifications
Route::get('notifications', 'RecommendationController@index')->middleware('JWT');
Route::post('storeExampleNotification', 'RecommendationController@storeExample')->middleware('JWT');

// Reset database
Route::get('reset-database', function (Request $request) {
    //return shell_exec('php artisan migrate:rollback') . shell_exec('php artisan migrate');
    \Illuminate\Support\Facades\Artisan::call('migrate:rollback');
    \Illuminate\Support\Facades\Artisan::call('migrate');
    return "Yey! Data has been reset. Go back to your tests, little grasshopper!";
});