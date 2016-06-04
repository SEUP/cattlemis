<?php

namespace App\Http\Requests;


use Illuminate\Contracts\Validation\Validator;

class CourseRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'course.year' => 'required',
            'course.semester' => 'required',
            'course.code' => 'required',
            'course.name' => 'required',
        ];
    }

}
