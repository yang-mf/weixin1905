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


Route::get('/weixin','WX\WXController@wx');
Route::get('/phpinfo','WX\WXController@phpinfo');
Route::post('/wx','WX\WXController@receiv');
Route::get('/wx/menu','WX\WXController@createMenu');        //创建菜单

Route::get('/vote','VoteController@index');

