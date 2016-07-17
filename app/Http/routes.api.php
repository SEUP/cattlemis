<?php

use Illuminate\Http\Request;

Route::get('/api/current_user', function () {
    return Auth::user();
});



