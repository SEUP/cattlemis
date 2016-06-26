<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Created by PhpStorm.
 * User: chaow
 * Date: 5/25/2016
 * Time: 3:50 PM
 */
class FarmInfo extends Model
{
    protected $fillable = [
        //part 1
        'drug_price','food_price' , 'expense_remark','expense_price'
        //part2
    ];

    public function farm_owner()
    {
        return $this->hasOne('App\Models\FarmOwner');
    }

    public function getFarmOwner()
    {
        return $this->farm_owner()->get();
    }
}
