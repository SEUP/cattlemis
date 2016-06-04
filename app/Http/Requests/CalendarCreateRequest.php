<?php

namespace App\Http\Requests;


use Illuminate\Contracts\Validation\Validator;

class CalendarCreateRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        $messages = [

        ];

        return $messages;
    }


    public function rules()
    {
        return [
            'calendar.name' => 'required',
        ];
    }

}
