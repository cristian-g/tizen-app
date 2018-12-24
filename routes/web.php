<?php

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
//Route::get('/{code}', 'Controller@handleCode');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Addons test
Route::get('/individual-purchase', function () {
    return view('individualPurchase');
});
Route::get('/company-purchase', function () {
    return view('companyPurchase');
});
Route::get('/auth', function () {
    return view('auth');
});