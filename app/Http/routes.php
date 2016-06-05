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
    if (Auth::user()) {
        return "index";
    } else {
        return redirect('/login');
    }

});

Route::get('login', function (\Illuminate\Support\Facades\Request $request) {
    return view('login');
});

Route::post('login', function (\Illuminate\Http\Request $request) {
    $login = $request->get('login');
    if (Auth::attempt($login)) {
        // Authentication passed...
        $user = Auth::user();
        if ($user->isAdmin()) {
            return redirect('/admin');
        } else {
            return redirect('/student');
        }

    } else {
        return Redirect::back()->withInput()->withErrors(['password' => 'Email and/or password invalid.']);
    }
});

Route::get('logout', function () {
    Auth::logout();
    return redirect('/login');
});


Route::resource('/api/user', "UserResourceController");
Route::resource('/api/user.calendar', "UserCalendarResourceController");
Route::resource('/api/user.calendar.event', "UserCalendarEventResourceController");
Route::get('/api/current_user', function () {
    return Auth::user();
});


Route::post('/api/questionair/', function (\App\Http\Requests\Questionair\QuestionairRequest $request) {
    $questionair = new \App\Models\Questionair();
    $questionair->fill($request->all());
    //$questionair->save();
    return $questionair;
});

