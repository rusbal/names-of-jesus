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

/**
 * Names
 */
Route::get('/names',     'NameController@index');
Route::get('/names/new', 'NameController@create');
Route::post('/names',    'NameController@store');

Route::get('/names/{name}/revisions/{revision}', 'NameController@show')->name('revision');
Route::patch('/names/{name}/revisions/{revision}', 'NameController@update');

/**
 * Admin
 */
Route::group(['namespace' => 'Admin'], function() {
    Route::get('admin/{admin}', 'AdminController@index');
    Route::patch('admin/{admin}', 'AdminController@update');
});

/**
 * Test Email
 */
Route::get('/raymond/mail', 'RaymondMailController@mail');

Route::get('/raymond/notify', function() {
    Event::listen(Illuminate\Notifications\Events\NotificationSent::class, function($event) { info($event->notifiable->email); });
    $user = \App\User::find(1);
    $user->notify(new \App\Notifications\RayNotification());
});

