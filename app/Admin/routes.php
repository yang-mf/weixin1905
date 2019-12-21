<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('admin.home');
    $router->resource('users', WxusersController::class);
    $router->resource('shop/admin', shopadminController::class);
    $router->resource('word', TextController::class);
    $router->resource('picture', ImgController::class);
    $router->resource('voice', VoiceController::class);

});
