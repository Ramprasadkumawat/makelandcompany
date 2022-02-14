<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', function () {
    return view('users.index');
});
// Route::get('/table', function () {
//     return view('pages.tables');
// });
Route::get('/table', 'TableController@index');

// village module
Route::get('/village', 'VillageController@index');
Route::get('/addVillage', 'VillageController@addVillage');
Route::post('add-student','VillageController@insert');
Route::get('/edit-village/{id}', 'VillageController@edit');
Route::post('/update-village', 'VillageController@update');

// Laser Account
Route::get('/laserac', 'LeaserACController@index');

Route::get('/home', 'HomeController@index');
Route::get('/register', 'Auth\RegisterController@create');
Route::get('/login', 'Auth\LoginController@validator');
Route::get('/register', 'Auth\RegisterController@register');
Route::get('/profile', 'ProfileController@edit');
