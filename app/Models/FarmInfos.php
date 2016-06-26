<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Created by PhpStorm.
 * User: chaow
 * Date: 5/25/2016
 * Time: 3:50 PM
 */
class FarmInfos extends Model
{
    protected $fillable = [
        //part 1
        'drug_price','food_price' , 'expense_remark','expense_price', 'total_cattle_amount',
        'total_male_breeder_amount', 'total_female_breeder_amount', 'total_male_cattle_aged_over_six_amount',
        'total_female_cattle_aged_over_six_amount','total_male_cattle_aged_under_six_amount', 'total_female_cattle_aged_under_six_amount',
        'total_expense_amount'
        //part2
    ];

    public function farm_owner()
    {
        return $this->belongsTo('App\Models\FarmOwner');
    }

    public function getFarmOwner()
    {
        return $this->farm_owner()->get();
    }
}
