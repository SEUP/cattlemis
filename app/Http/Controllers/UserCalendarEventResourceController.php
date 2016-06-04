<?php

namespace App\Http\Controllers;

use App\Models\Calendar;
use App\Models\CalendarEvent;
use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Requests;

class UserCalendarEventResourceController extends Controller
{
    public function index(Request $request, $userId, $calendarId)
    {

        $start = $request->get('start');
        $end = $request->get('end');

        /* @var Calendar $calendar */
        $calendar = Calendar::find($calendarId);
        $events = $calendar->events()
            ->whereBetween('start', [$start, $end])
            //->orWhereBetween('end', [$start, $end])
            ->get();
        return $events;
    }

//    public function create($userId)
//    {
//        return new Calendar();
//    }

//    public function store(Request $request, $userId)
//    {
//        /* @var User $user */
//        $user = User::find($userId);
//
//        $calendar = Calendar::create($request->get('calendar'));
//        $user->calendars()->save($calendar);
//
//    }

//    public function show($userId, $calendarId)
//    {
//        $calendar = Calendar::find($calendarId);
//        return $calendar;
//    }
//
//    public function edit($userId, $calendarId)
//    {
//        /* @var User $user */
//        $calendar = Calendar::find($calendarId);
//        return $calendar;
//
//    }

    public function update(Request $request, $userId, $calendarId, $eventId)
    {
        return $request->all();
        $event->fill($request->all());
        $event->allday = $request->input('allDay', false) ? true : false;
        $event->save();
        return $event;
    }

//    public function destroy($userId, $calendarId)
//    {
//        $calendar = Calendar::find($calendarId);
//        $calendar->delete();
//        return [true];
//    }

}
