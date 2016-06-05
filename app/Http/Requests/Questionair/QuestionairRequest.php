<?php

namespace App\Http\Requests\Questionair;


use App\Http\Requests\Request;
use Illuminate\Contracts\Validation\Validator;

class QuestionairRequest extends Request
{
    public function authorize()
    {
        return true;
    }

//    public function messages()
//    {
//        $messages = [
//            'user.password.same' => 'The password and verify password must match!',
//        ];
//
//        return $messages;
//    }


    public function rules()
    {
        return [
            'firstname' => 'required',
            'lastname' => 'required',
            'person_id' => 'required',
        ];
    }

}
