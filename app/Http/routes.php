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
Route::get('user/add', 'UserController@addUser');
Route::post('user/register', 'UserController@createUser');
Route::get('user/edit/{user_id}', 'UserController@editUser');
Route::post('user/save', 'UserController@saveUser');


Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
