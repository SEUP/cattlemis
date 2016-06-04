<?php

namespace App\Http\Requests;


class UserUpdateRequest extends Request
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
            'user.email' => 'required|exists:users,email',
            'user.password' => 'same:user.vpassword',
        ];
    }

}
