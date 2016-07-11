<?php

namespace App\Http\Controllers;

use App\Models\Calendar;
use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Requests;

class UserCalendarResourceController extends Controller
{
    public function index($userId)
    {
        $user = User::find($userId);
        return $user->calendars;
    }

    public function create($userId)
    {
        return new Calendar();
    }

    public function store(Request $request, $userId)
    {
        /* @var User $user */
        $user = User::find($userId);

        $calendar = Calendar::create($request->get('calendar'));
        $user->calendars()->save($calendar);

    }

    public function show($userId, $calendarId)
    {
        $calendar = Calendar::find($calendarId);
        return $calendar;
    }

    public function edit($userId, $calendarId)
    {
        /* @var User $user */
        $calendar = Calendar::find($calendarId);
        return $calendar;

    }

    public function update(Request $request, $userId, $calendarId)
    {
        /* @var User $user */
        $calendar = Calendar::find($calendarId);
        $calendar->fill($request->get('calendar'));
        $calendar->save();
        return $calendar;
    }

    public function destroy($userId, $calendarId)
    {
        $calendar = Calendar::find($calendarId);
        $calendar->delete();
        return [true];
    }

}
