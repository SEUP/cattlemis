<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Created by PhpStorm.
 * User: chaow
 * Date: 5/25/2016
 * Time: 3:50 PM
 */
class FarmOwner extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'person_id',
        'house_no',
        'house_moo',
        'house_provice',
        'house_district',
        'house_suburb',
        'house_postcode',
        'house_phone',
        'mobile_no',
        'email',
        'farm_name',
        'farm_no',
        'farm_province',
        'farm_district',
        'farm_suburb',
        'farm_lat',
        'farm_long',
        'age',
        'avg_cattle_income',
    ];

    public function sex()
    {
        return $this->belongsToMany(Choice::class, "choice_farm_owner")->where('choice_farm_owner.type', '=', 'sex');
    }

}