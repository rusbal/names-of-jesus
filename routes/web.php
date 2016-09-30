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
Route::post('/names', 'NameController@store');
Route::get('/names/{name}', 'NameController@show')->name('working_revision');
Route::patch('/names/{name}', 'NameController@update');

Route::get('/names/{name}/revisions/{revision}', 'NameController@show')->name('revision');
// Route::post('/names/{name}/revisions/{revision}', 'NameController@show');

/**
 * Test Email
 */
Route::get('/raymond/mail', 'RaymondMailController@mail');

Route::get('/raymond/notify', function() {
    Event::listen(Illuminate\Notifications\Events\NotificationSent::class, function($event) { info($event->notifiable->email); });
    $user = \App\User::find(1);
    $user->notify(new \App\Notifications\RayNotification());
});

