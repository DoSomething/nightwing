<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['middleware' => ['web']], function () {
    Route::get('/', function () {
        return view('pages.home');
    });

    Route::get('login', 'AuthController@getLogin');
    Route::get('logout', 'AuthController@getLogout');

    Route::resource('redirects', 'RedirectsController');
});
