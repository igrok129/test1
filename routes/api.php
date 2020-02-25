<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/phone-book', 'PhoneBookController@index')->name('phone-book.get');
Route::post('/phone-book', 'PhoneBookController@store')->name('phone-book.store');
Route::put('/phone-book/{id}', 'PhoneBookController@update')->name('phone-book.update');
