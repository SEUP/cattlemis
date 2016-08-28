<?php

namespace App\Http\Requests;


use Illuminate\Contracts\Validation\Validator;

class FarmOwnerRequest extends Request
{
    public function authorize()
    {
        return true;
    }


    public function rules()
    {


        switch($this->method())
        {
            case 'GET':
            case 'DELETE':
            {
                return [];
            }
            case 'POST':
            {
                return [
                    'first_name' => 'required',
                    'last_name' => 'required',
                    'person_id' => 'required|unique:farm_owners,person_id',
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                $farmOwner = $this->get('id');

                return [
                    'first_name' => 'required',
                    'last_name' => 'required',
                    'person_id' => "required|unique:farm_owners,person_id,$farmOwner",

                ];
            }
            default:break;
        }
    }

}
