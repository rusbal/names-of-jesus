<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/names', 'NameController@index');

/**
 * Names
 */
Route::get('/names/new', 'NameController@create');
Route::post('/names/new', 'NameController@store');

Route::get('/name/{id?}', 'NameController@show');
Route::post('/name/{id?}', 'NameController@update');

