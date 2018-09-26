<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'UserController@index');

Route::get('home', 'UserController@index');
Route::get('user/list', 'UserController@loadUsers');
Route::get('user/create', 'UserController@create');
Route::post('user/store', 'UserController@store');
Route::get('user/edit/{id}', 'UserController@edit');
Route::post('user/update/{id}', 'UserController@update');
Route::post('user/destroy/{id}', 'UserController@destroy');


Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);
