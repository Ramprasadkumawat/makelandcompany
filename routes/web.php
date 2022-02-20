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

//Route::get('/', 'User\HomeController@index');

Route::get('/', 'Admin\HomeController@index');
Route::get('/admin', 'Admin\HomeController@index')->name('admin');


Auth::routes();

/*Admin Routes*/
Route::prefix('admin')->group(function() {
    Route::get('/login/', 'Auth\LoginController@showAdminLoginForm');
    Route::get('/register', 'Auth\RegisterController@showAdminRegisterForm');

    Route::post('/login', 'Auth\LoginController@adminLogin');
    Route::post('/register', 'Auth\RegisterController@createAdmin');

    /*Admin Users Route*/
    
    // village routing
    Route::get('/villages', 'Admin\VillageController@index')->name('admin.villages');
    Route::get('/get-villages', 'Admin\VillageController@getVillagesData')->name('admin.get_villages');
    Route::get('/create-village', 'Admin\VillageController@create')->name('admin.create-village');
    Route::post('/store-village', 'Admin\VillageController@store')->name('admin.store-village');
    Route::get('/edit-village/{id?}', 'Admin\VillageController@edit')->name('admin.edit-village');
    Route::post('/update-village', 'Admin\VillageController@update')->name('admin.update-village');
    Route::get('/delete-village/{id}', 'Admin\VillageController@destroy')->name('admin.delete_village');
    
    // Cold-store routing
    Route::get('/cold-store', 'Admin\ColdStoreController@index')->name('admin.cold-store');
    Route::get('/get-cold-stores', 'Admin\ColdStoreController@getColdStoragesData')->name('admin.get_cold-stores');
    Route::get('/create-cold-store', 'Admin\ColdStoreController@create')->name('admin.create-cold-store');
    Route::post('/store-cold-store', 'Admin\ColdStoreController@store')->name('admin.store-cold-store');
    Route::get('/edit-cold-store/{id?}', 'Admin\ColdStoreController@edit')->name('admin.edit-cold-store');
    Route::post('/update-cold-store', 'Admin\ColdStoreController@update')->name('admin.update-cold-store');
    Route::get('/delete-cold-store/{id}', 'Admin\ColdStoreController@destroy')->name('admin.delete_cold-store');
    
    // Sell routing
    Route::get('/sell', 'Admin\SellController@index')->name('admin.sell');
    Route::get('/get-sells', 'Admin\SellController@getSells')->name('admin.get_sell');
    Route::get('/create-sell', 'Admin\SellController@create')->name('admin.create-sell');
    Route::post('/store-sell', 'Admin\SellController@store')->name('admin.store-sell');
    Route::get('/edit-sell/{id?}', 'Admin\SellController@edit')->name('admin.edit-sell');
    Route::post('/update-sell', 'Admin\SellController@update')->name('admin.update-sell');
    Route::get('/delete-sell/{id}', 'Admin\SellController@destroy')->name('admin.delete_sell');

    // users routing
    Route::get('/users', 'Admin\UserController@index')->name('admin.users');
    Route::get('/get-users', 'Admin\UserController@getUsersData')->name('admin.get_users');
    Route::get('/delete-user/{id}', 'Admin\UserController@destroy')->name('admin.delete_user');
    Route::get('/create-user', 'Admin\UserController@create')->name('admin.create-user');
    Route::post('/store-user', 'Admin\UserController@store')->name('admin.store-user');
    Route::get('/edit-user/{id?}', 'Admin\UserController@edit')->name('admin.edit-user');
    Route::post('/update-user', 'Admin\UserController@update')->name('admin.update-user');

    /*Fetch States And Cities Json*/
    Route::get('/fetch-states/', 'Admin\HomeController@fetchStates')->name('admin.fetch-states');

    Route::get('/fetch-cities/', 'Admin\HomeController@fetchCities')->name('admin.fetch-cities');


    /*Admin Country Route*/
    Route::get('/countries', 'Admin\CountryController@index')->name('admin.countries');
    Route::get('/get-countries', 'Admin\CountryController@getCountriesData')->name('admin.get_countries');
    Route::get('/delete-country/{id}', 'Admin\CountryController@destroy')->name('admin.delete_country');
    Route::get('/create-country', 'Admin\CountryController@create')->name('admin.create-country');
    Route::post('/store-country', 'Admin\CountryController@store')->name('admin.store-country');
    Route::get('/edit-country/{id?}', 'Admin\CountryController@edit')->name('admin.edit-country');
    Route::post('/update-country', 'Admin\CountryController@update')->name('admin.update-country');

    /*Admin State Route*/
    Route::get('/states', 'Admin\StateController@index')->name('admin.states');
    Route::get('/get-states', 'Admin\StateController@getStatesData')->name('admin.get_states');
    Route::get('/delete-state/{id}', 'Admin\StateController@destroy')->name('admin.delete_state');
    Route::get('/create-state', 'Admin\StateController@create')->name('admin.create-state');
    Route::post('/store-state', 'Admin\StateController@store')->name('admin.store-state');
    Route::get('/edit-state/{id?}', 'Admin\StateController@edit')->name('admin.edit-state');
    Route::post('/update-state', 'Admin\StateController@update')->name('admin.update-state');

    /*Admin City Route*/
    Route::get('/cities', 'Admin\CityController@index')->name('admin.cities');
    Route::get('/get-cities', 'Admin\CityController@getCitiesData')->name('admin.get_cities');
    Route::get('/delete-city/{id}', 'Admin\CityController@destroy')->name('admin.delete_city');
    Route::get('/create-city', 'Admin\CityController@create')->name('admin.create-city');
    Route::post('/store-city', 'Admin\CityController@store')->name('admin.store-city');
    Route::get('/edit-city/{id?}', 'Admin\CityController@edit')->name('admin.edit-city');
    Route::post('/update-city', 'Admin\CityController@update')->name('admin.update-city');

    /*Admin Suggestion Route*/
    Route::get('/suggestions', 'Admin\SuggestionController@index')->name('admin.suggestions');
    Route::get('/get-suggestions', 'Admin\SuggestionController@getSuggestionData')->name('admin.get_suggestions');
    Route::get('/show-suggestion/{id}/', 'Admin\SuggestionController@show')->name('admin.show-suggestion');
    Route::get('/mark-as-read/{id}/{status}', 'Admin\SuggestionController@markAsRead')->name('admin.mark-as-read');

    /*Admin Pages Route*/
    Route::get('/pages', 'Admin\StaticPageController@index')->name('admin.pages');
    Route::get('/get-pages', 'Admin\StaticPageController@getPagesData')->name('admin.get_pages');
    Route::get('/delete-page/{id}', 'Admin\StaticPageController@destroy')->name('admin.delete_page');
    Route::get('/create-page', 'Admin\StaticPageController@create')->name('admin.create-page');
    Route::post('/store-page', 'Admin\StaticPageController@store')->name('admin.store-page');
    Route::get('/edit-page/{id?}', 'Admin\StaticPageController@edit')->name('admin.edit-page');
    Route::get('/show-page/{id?}', 'Admin\StaticPageController@show')->name('admin.show-page');
    Route::post('/update-page', 'Admin\StaticPageController@update')->name('admin.update-page');

    Route::get('/dashboard', 'Admin\HomeController@index')->name('admin.dashboard');
    Route::get('/profile/', 'Admin\HomeController@profile')->name('admin.profile');
    Route::post('/update-profile/', 'Admin\HomeController@updateProfile')->name('admin.update-profile');
    Route::get('/change-password/', 'Admin\HomeController@changePassword')->name('admin.change-password');
    Route::post('/update-admin-password/', 'Admin\HomeController@updatePassword')->name('admin.update-password');

    Route::get('/configuration/', 'Admin\ConfigurationController@configuration')->name('admin.configuration');
    Route::post('/update-configuration/', 'Admin\ConfigurationController@updateConfiguration')->name('admin.update.configuration');

});

/*Image Upload Routes*/
Route::get('/drop-zone', 'DropzoneFileUploadController@index')->name('drop-zone');
Route::post('store-image-drop', 'DropzoneFileUploadController@uploadImages');
Route::post('delete-image-drop', 'DropzoneFileUploadController@deleteImage');
