<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
|
| Here is where you can register User routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your User!
|
*/

Route::get('/', function(){
    echo "User Routes";
});

Route::post('/register', 'API\Users\UserController@register')->name('user.register');
Route::post('/login', 'API\Users\UserController@login')->name('user.login');
Route::post('/logout', 'API\Users\UserController@logout')->name('user.logout');
