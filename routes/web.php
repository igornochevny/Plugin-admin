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

Route::group(['middleware' => 'auth'], function () {

    Route::get('/', 'UserController@index')->name('home');

    Route::post('/create-user', 'AdminController@createUser')->name('create-user');

    /** users */
    Route::resource('/users', 'UserController');

    Route::get('/users/{user}/activate', 'UserController@activate')->name('activate');

    Route::get('/users/{user}/deactivate', 'UserController@deactivate')->name('deactivate');
});