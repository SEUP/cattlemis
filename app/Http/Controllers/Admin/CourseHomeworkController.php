<?php

namespace App\Http\Controllers\Admin;

/**
 * Created by PhpStorm.
 * User: chaow
 * Date: 5/30/2016
 * Time: 8:33 AM
 */

use App\Http\Requests\CourseHomeworkRequest;
use App\Http\Requests\CourseRequest;
use App\Models\Course;
use App\Models\Homework;

use App\Http\Controllers\Controller;

class CourseHomeworkController extends Controller
{

    private $namespace = __NAMESPACE__;

    public function index($id, $hid)
    {
        $course = Course::find($id);
        $homework = Homework::find($hid);
        return view('admin.course.homework.index')
            ->with('course', $course)
            ->with('homework', $homework);
    }

    public function add($id)
    {
        $course = Course::find($id);
        return view('admin.course.homework.add')
            ->with('course', $course);

    }

    function doAdd(CourseHomeworkRequest $request, $id)
    {
        $homework = Homework::create($request->get('homework'));
        $course = Course::find($id);
        $course->homeworks()->save($homework);
        return redirect()->action("\\$this->namespace\\CourseController@view", ['id' => $id])->with("SUCCESS_MESSAGE", ['msg' => 'Homework Created']);
    }

    function edit($id, $hid)
    {
        $course = Course::find($id);
        $homework = Homework::find($hid);
        return view('admin.course.homework.edit')
            ->with('homework', $homework)
            ->with('course', $course);
    }

    function doEdit(CourseHomeworkRequest $request, $id, $hid)
    {
        $homework = Homework::find($hid);
        $homework->fill($request->get('homework'));
        $homework->save();
        return redirect()->action("\\$this->namespace\\CourseController@view", ['id' => $id])->with("SUCCESS_MESSAGE", ['msg' => 'Homework Updated.']);
    }

    function doDelete($id, $hid)
    {
        $homework = Homework::find($hid);
        $homework->delete();
        return redirect()->action("\\$this->namespace\\CourseController@view", ['id' => $id])->with("SUCCESS_MESSAGE", ["msg" => "Homework deleted"]);
    }

}