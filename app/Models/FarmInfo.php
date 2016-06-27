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
        //part2
        'drug_price', 'food_price', 'expense_remark', 'expense_price', 
        'total_master_breeding_types', 'total_male_breeding_types',
        'total_female_breeding_types', 'total_male_over_six_breeding_types', 
        'total_female_over_six_breeding_types',
        'total_male_under_six_breeding_types', 'total_female_under_six_breeding_types', 
        'total_expense_amount'
        
    ];

    public function farm_owner()
    {
        return $this->belongsTo(FarmOwner::class);
    }

    public function getFarmOwner()
    {
        return $this->farm_owner()->get();
    }
}
