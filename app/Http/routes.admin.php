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


Route::get('/', function () {
    return view('admin.dashboard');
});

//user routes
Route::get('user', "UserController@index");
Route::get('user/add', "UserController@add");
Route::post('user/add', "UserController@doAdd");
Route::get('user/{id}/edit', "UserController@edit");
Route::post('user/{id}/edit', "UserController@doEdit");
Route::get('user/{id}/delete', "UserController@doDelete");

//profile routes
Route::get('profile', "ProfileController@index");
Route::post('profile', "ProfileController@doEdit");

//questionair routes
Route::get('questionair/add', 'QuestionairController@add');
Route::get('questionair/search', 'QuestionairController@index');
Route::get('questionair/{id}/edit', "QuestionairController@edit");
Route::get('questionair/{id}/delete', "QuestionairController@doDelete");


//choice
Route::get('choice', 'ChoiceController@index');