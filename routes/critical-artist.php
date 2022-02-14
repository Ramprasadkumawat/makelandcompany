<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Critical Routes
|--------------------------------------------------------------------------
|
| Here is where you can register Critical routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your Critical!
|
*/

Route::get('/', function(){
    echo "Critical Artist Routes";
});