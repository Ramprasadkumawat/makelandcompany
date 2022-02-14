<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Artist Routes
|--------------------------------------------------------------------------
|
| Here is where you can register Artist routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your Artist!
|
*/

Route::get('/', function(){
    echo "Artist Routes";
});