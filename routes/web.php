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
Route::get('/ac','WX\WXController@access_token');        //创建菜单
Route::get('/newyear','WX\WXController@NewYear');        //创建菜单
Route::get('/wx/getticket','WX\TicketController@getticket');        //二维码

Route::get('/wx/acc','WX\WXController@Newaccess_token');


Route::get('/wx/gettoken','WX\WXController@Getaccess_token');        //access_token
Route::get('/newwx','WX\WXController@checkSignature');
//Route::post('/newwx','WX\WXController@receiv');   //




Route::get('/control','ControlController@index');
Route::get('/vote','VoteController@index');
Route::get('/shop','ShopController@index');
Route::get('/shop/detail','ShopController@detail');


Route::get('/weather','weather@index');




