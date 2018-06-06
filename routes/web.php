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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/setting', 'SettingController@index');
Route::put('/setting_items/{setting_item}', 'SettingController@updateSettingItem');
Route::post('/setting_item_option_check', 'SettingItemOptionCheckController@store');
Route::delete('/setting_item_option_check', 'SettingItemOptionCheckController@destroy');

Route::get('/items', 'ItemController@index');
