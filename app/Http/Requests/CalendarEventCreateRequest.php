<?php

namespace App\Http\Requests;


use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;

class CalendarEventCreateRequest extends Request
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
        if ($this->ajax()) {
            return [
                'title' => 'required',
                'start' => 'required',
                'end' => 'required',
            ];
        } else {
            return [
                'event.title' => 'required',
                'event.start' => 'required',
                'event.end' => 'required',
            ];
        }
    }

}
