<?php

namespace App\Http\Requests;


use Illuminate\Contracts\Validation\Validator;

class CourseHomeworkRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'homework.title' => 'required',
        ];
    }

}
