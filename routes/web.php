<?php

use Encore\infinitree\Http\Controllers\infinitreeController;
use Illuminate\Routing\Route;

//Route::get('infinitree', infinitreeController::class.'@index');


//$router->resource('auth/menu', 'MenuController', ['except' => ['create']])->names('admin.auth.menu');


app('router')->resource('infinitree', infinitreeController::class);

/*
$attributes = [
    'prefix'     => config('admin.route.prefix'),
    'middleware' => config('admin.route.middleware'),
];
app('router')->group($attributes, function ($router) {
    app('router')->resource('infinitree', infinitreeController::class.'@index');
    
    
});

*/