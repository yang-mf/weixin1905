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


Route::get('/wx','WX\WXController@wx');
Route::get('/phpinfo','WX\WXController@phpinfo');
Route::get('/receiv','WX\WXController@receiv');




