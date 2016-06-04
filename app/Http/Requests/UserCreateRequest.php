<?php

namespace App\Http\Requests;


use Illuminate\Contracts\Validation\Validator;

class UserCreateRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        $messages = [
            'user.password.same' => 'The password and verify password must match!',
        ];

        return $messages;
    }


    public function rules()
    {
        return [
            'user.firstname' => 'required',
            'user.lastname' => 'required',
            'user.email' => 'required|email|unique:users,email',
            'user.password' => 'required|same:user.vpassword',
        ];
    }

}
