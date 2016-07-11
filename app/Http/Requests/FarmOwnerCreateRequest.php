<?php

namespace App\Http\Requests;


use Illuminate\Contracts\Validation\Validator;

class FarmOwnerCreateRequest extends Request
{
    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'person_id' => 'required|unique:farm_owners,person_id',
        ];
    }

}
