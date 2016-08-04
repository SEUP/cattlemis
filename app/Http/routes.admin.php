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
//    return view('admin.dashboard');
    return redirect()->action("Admin\\QuestionaireController@index");
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

//questionaire routes
Route::get('questionaire/add', 'QuestionaireController@add');
Route::get('questionaire/search', 'QuestionaireController@index');
Route::get('questionaire/{id}/edit', "QuestionaireController@edit");
Route::get('questionaire/{id}/delete', "QuestionaireController@doDelete");
Route::get('questionaire/{id}/export', 'QuestionaireController@export');
//choice
Route::get('choice', 'ChoiceController@index');

//charts
Route::get('charts/menuchart', function () {
    return view("admin.charts.menuChart");
});
Route::get('charts/normal/{title}/{type}', function ($title, $type) {

    return view("admin.charts.normalChart")
        ->with('title', $title)
        ->with('type', $type);
});

Route::get('charts/pie/{title}/{type}', function ($title, $type) {

    return view("admin.charts.pieChart")
        ->with('title', $title)
        ->with('type', $type);
});

Route::get('charts/multi-choice/{title}/{type}', function ($title, $type) {

    return view("admin.charts.multiChoiceChart")
        ->with('title', $title)
        ->with('type', $type);
});


Route::get('charts/range-farmowner/{title}/{type}/{min}/{max}/{step}',
    function ($title, $type, $min, $max, $step) {

        return view("admin.charts.farmownerRangeChart")
            ->with('title', $title)
            ->with('type', $type)
            ->with('min', $min)
            ->with('max', $max)
            ->with('step', $step);
    });