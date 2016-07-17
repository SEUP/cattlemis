<?php

use Illuminate\Http\Request;

Route::post('/api/login', function (Request $request) {
    $login = $request->all();
    if (Auth::attempt($login)) {

        // Authentication passed...
        $user = Auth::user();

        if ($user->isAdmin()) {

            return response()->json([
                'auth' => true,
                'user' => $user,
                'intended' => \Url::route('/admin')
            ]);

        } else {
            return response()->json([
                'auth' => true,
                'user' => $user,
                'intended' => \Url::route('/student')
            ]);
        }

    } else {
        return redirect(URL::route('/login'));
    }
});

Route::get('/api/current_user', function () {
    return Auth::user();
});


Route::group([
    'middleware' => ['roles'], 'roles' => ['admin']
], function () {

    Route::resource('/api/farm-owner', "FarmOwnerController");

    Route::resource('/api/thailand/province', "ProvinceController");
    Route::resource('/api/thailand/province.amphure', "ProvinceAmphureController");
    Route::resource('/api/thailand/province.amphure.district', "ProvinceAmphurDistrictController");

    Route::get('/api/choice', function () {
        $choices = \App\Models\Choice::with([])->get()->groupBy("type");
        return $choices;
    });

    Route::get('/api/choice/{type}', function ($type) {
        $choices = \App\Models\Choice::where('type', '=', $type)->get();
        return $choices;
    });


    Route::resource('/api/user', "UserResourceController");
    Route::resource('/api/user.calendar', "UserCalendarResourceController");
    Route::resource('/api/user.calendar.event', "UserCalendarEventResourceController");

});


