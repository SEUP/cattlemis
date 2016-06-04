<?php

namespace App\Http\Requests;


class ProfileRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        $messages = [
            'profile.password.same' => 'The password and verify password must match!',
        ];

        return $messages;
    }


    public function rules()
    {
        return [
            'profile.firstname' => 'required',
            'profile.lastname' => 'required',
            'profile.email' => 'required|exists:users,email',
            'profile.password' => 'same:profile.vpassword',
        ];
    }

}
