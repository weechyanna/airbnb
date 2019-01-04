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

Route::get('/', 'RoomsController@index')->name('root');
Route::get('rooms', 'RoomsController@index')->name('rooms.index');


Route::middleware('auth')->group(function (){
    Route::get('rooms/create', 'RoomsController@create')->name('rooms.create');
    Route::post('rooms', 'RoomsController@store')->name('rooms.store');

    Route::get('rooms/{room}/edit', 'RoomsController@edit')->name('rooms.edit');
    Route::put('rooms/{room}', 'RoomsController@update')->name('rooms.update');

    Route::delete('rooms/{room}', 'RoomsController@destroy')->name('rooms.delete');

    Route::get('logout', 'AuthController@logout')->name('logout');
});

Route::middleware('guest')->group(function(){
    Route::get('login', 'AuthController@showLogin')->name('login.show');
    Route::post('login', 'AuthController@login')->name('login.store');

    Route::get('signup', 'AuthController@showSignup')->name('signup.show');
    Route::post('signup', 'AuthController@signup')->name('signup.store');
});

Route::middleware('is_admin')->group(function(){
    Route::get('admin', 'AdminController@index')->name('admin.index');

});
