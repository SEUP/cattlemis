<?php


Route::resource('/api/user', "UserResourceController");
Route::resource('/api/user.calendar', "UserCalendarResourceController");
Route::resource('/api/user.calendar.event', "UserCalendarEventResourceController");
Route::get('/api/current_user', function () {
    return Auth::user();
});


Route::get('/api/choice', function () {
    $choices = \App\Models\Choice::with([])->get()->groupBy("type");
    return $choices;
});

Route::get('/api/choice/{type}', function ($type) {
    $choices = \App\Models\Choice::where('type', '=', $type)->get();
    return $choices;
});


Route::resource('/api/farm-owner', "FarmOwnerController");

Route::resource('/api/thailand/province', "ProvinceController");
Route::resource('/api/thailand/province.amphure', "ProvinceAmphureController");
Route::resource('/api/thailand/province.amphure.district', "ProvinceAmphurDistrictController");


