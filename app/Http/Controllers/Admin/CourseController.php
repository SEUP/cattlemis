<?php

namespace App\Http\Controllers\Admin;

/**
 * Created by PhpStorm.
 * User: chaow
 * Date: 5/30/2016
 * Time: 8:33 AM
 */

use App\Http\Requests\CourseRequest;
use App\Models\Course;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserCreateRequest;
use \App\Http\Requests\UserUpdateRequest;
use App\Models\Role;
use App\Models\User;


class CourseController extends Controller
{

    private $namespace = __NAMESPACE__;

    public function index()
    {
        $courses = Auth::user()->courses()->paginate(15);
        return view('admin.course.index')
            ->with('courses', $courses);
    }

    public function add()
    {
        return view('admin.course.add');

    }

    function doAdd(CourseRequest $request)
    {
        $course = \App\Models\Course::create($request->get('course'));
        $user = Auth::user();
        $user->courses()->save($course);
        return redirect()->to("/admin/course")->with("SUCCESS_MESSAGE", ['msg' => 'Course Created']);
    }

    function edit($id)
    {
        $course = \App\Models\Course::find($id);
        return view('admin.course.edit')
            ->with('course', $course);
    }

    function doEdit(CourseRequest $request, $id)
    {
        $course = \App\Models\Course::find($id);
        $course->fill($request->get('course'));
        $course->save();
        return redirect()->to("/admin/course")->with("SUCCESS_MESSAGE", ['msg' => 'Course Updated.']);
    }

    function doDelete($id)
    {
        $course = \App\Models\Course::find($id);
        $course->delete();
        return redirect()->to("/admin/course")->with("SUCCESS_MESSAGE", ["msg" => "Course deleted"]);
    }

    function view($id)
    {
        $course = Course::find($id);
        return view('admin.course.view')
            ->with('course', $course);
    }

}