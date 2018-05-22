<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Created by PhpStorm.
 * User: chaow
 * Date: 5/25/2016
 * Time: 3:50 PM
 */
class FarmOwner2 extends Model
{

    protected $table = "farm_owners";
    protected $fillable = [
        //part 1
        'first_name', 'last_name', 'person_id', 'house_no', 'house_moo', 'house_province',
        'house_district', 'house_amphur', 'house_postcode', 'house_phone', 'mobile_no', 'email',
        'farm_name', 'farm_no', 'farm_moo', 'farm_province', 'farm_district', 'farm_amphur',
        'farm_lat', 'farm_long', 'age', 'avg_cattle_income',

        //part2
        'drug_price', 'food_price',
        //'expense_remark', 
        'expense_price',
        'total_master_breeding_types', 'total_male_breeding_types',
        'total_female_breeding_types', 'total_male_over_six_breeding_types',
        'total_female_over_six_breeding_types',
        'total_male_under_six_breeding_types', 'total_female_under_six_breeding_types',
        'total_expense_amount',

        //part3
        'total_workers_amount', 'family_workers_amount', 'external_workers_amount', 'total_own_lands',
        'total_use_lands',

        //part4
        'breeding_rate',

        //part5
        'total_budget',

        //part6
        'cattle_sold_age', 'cattle_sold_weight',

        //part 8
        'problem', 'suggestion'


    ];

    public function choices(){
        return $this->belongsToMany(Choice::class,"choice_farm_owner","farm_owner_id","choice_id")
            ->withPivot(['remark', 'amount', 'source', 'source_opt', 'price', 'area', 'subarea', 'width', 'height', 'rate', 'joined', 'age_range_sale', 'price_range_sale']);
    }

}