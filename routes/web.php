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
Route::get('/names', 'NameController@index');
Route::get('/names/new', 'NameController@create');
Route::post('/names/new', 'NameController@store');
Route::get('/names/{id?}', 'NameController@show');
Route::post('/names/{id?}', 'NameController@update');

Route::get('/revision/{id?}', 'RevisionController@show')->name('revision');

/**
 * Test Email
 */
Route::get('/raymond/mail', 'RaymondMailController@mail');

Route::get('/raymond/notify', function() {
    Event::listen(Illuminate\Notifications\Events\NotificationSent::class, function($event) { info($event->notifiable->email); });
    $user = \App\User::find(1);
    $user->notify(new \App\Notifications\RayNotification());
});

