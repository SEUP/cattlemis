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

Route::get('calendar', function () {
    return view('admin.calendar.index');
});

Route::get('calendar/add', function () {
    return view('admin.calendar.add');
});

Route::post('calendar/add', function (\App\Http\Requests\CalendarCreateRequest $request) {
    $calendarForm = $request->get('calendar');
    $calendar = \App\Models\Calendar::create($calendarForm);
    /* @var \App\Models\User $user */
    $user = Auth::user();
    $user->calendars()->save($calendar);

    return redirect('admin/calendar')->with("SUCCESS_MESSAGE", ['msg', "Calendar Created."]);

});

Route::get('calendar/{id}/event/add', function ($id) {
    $calendar = \App\Models\Calendar::find($id);
    return view('admin.calendar.addEvent')
        ->with('calendar', $calendar);
});

Route::post('calendar/{id}/event/add', function (\App\Http\Requests\CalendarEventCreateRequest $request, $id) {

    $event = \App\Models\CalendarEvent::create($request->get('event'));
    $event->allday = $request->input('event.allday', false) ? true : false;
    //dd($event);
    //dd($request->input('event.allday',false));
    $calendar = \App\Models\Calendar::find($id);
    $calendar->events()->save($event);

    return redirect('admin/calendar')->with("SUCCESS_MESSAGE", ['msg', "Event Created."]);

});

Route::get('/facebook/chat', function () {
    return view('admin.facebook.chat');
});

Route::get('profile', "ProfileController@index");

Route::post('profile', "ProfileController@doEdit");

Route::get('profile/{social}/unlink', "ProfileController@doUnlink");

Route::get('profile/{social}/callback', "ProfileController@socialCallback");


//courses
Route::get('course', "CourseController@index");
Route::get('course/add', "CourseController@add");
Route::post('course/add', "CourseController@doAdd");
Route::get('course/{id}', "CourseController@view");
Route::get('course/{id}/edit', "CourseController@edit");
Route::post('course/{id}/edit', "CourseController@doEdit");
Route::get('course/{id}/delete', "CourseController@doDelete");

Route::get('course/{id}/homework/add', "CourseHomeworkController@add");
Route::post('course/{id}/homework/add', "CourseHomeworkController@doAdd");
Route::get('course/{id}/homework/{hid}/edit', "CourseHomeworkController@edit");
Route::post('course/{id}/homework/{hid}/edit', "CourseHomeworkController@doEdit");
Route::get('course/{id}/homework/{hid}/delete', "CourseHomeworkController@doDelete");
Route::get('course/{id}/homework/{hid}', "CourseHomeworkController@index");
