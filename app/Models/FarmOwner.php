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

    protected $hidden = [
        'sexes', 'family_statuses', 'choices', 'educations', 'cattle_jobs', 'income_ranges',

    ];

    protected $appends = [

        //normal relationship
        //select option or checkbox relationship
        //part1
        'sex', 'family_status', 'education', 'social_status', 'personal_status', 'cattle_job', 'income_range',
        'jobtypes',

        //part2
        'farm_purposes', 'farm_record',
        'farm_exp', 'farm_future',
        'master_breeding_types', 'male_breeding_types',
        'male_int_breeding_types', 'male_mixed_breeding_types', 'female_breeding_types',
        'female_int_breeding_types', 'female_mixed_breeding_types', 'male_over_six_breeding_types',
        'male_over_six_int_breeding_types', 'male_over_six_mixed_breeding_types',
        'female_over_six_breeding_types', 'female_over_six_int_breeding_types',
        'female_over_six_mixed_breeding_types', 'male_under_six_breeding_types',
        'male_under_six_int_breeding_types', 'male_under_six_mixed_breeding_types',
        'female_under_six_breeding_types', 'female_under_six_int_breeding_types',
        'female_under_six_mixed_breeding_types',
        //'farm_info',
        'farm_register_status',
        'farm_register',
        'farm_disease_check',
        'abortion', 'tuberculosis', 'foot_mouth_disease',

        //part3
        'own_land', 'rent_land', 'use_land', 'minerals_feed', 'feedstock',
        'water_source_types', 'take_care_types',
        'sub_own_lands', 'sub_use_lands',
        'feed_types', 'feed_sources', 'feedstock_types',
        'feed_summer_sources',

        //part4
        'farm_breeding_type','cattle_death','dewormed_amount','vaccine_ever','biogas_status',
        'vaccined_by',
        'inseminate_sources','breeders','cattle_death_causes','disease_cured_by',
        'cattle_dung_uses',

        //part5
        'budget_source', 'loan_types',

        //part6
        'seller_types', 'cattle_sale_methods', 'group_joins',
        'group_join_future', 'cooperative_help_types', 'feed_purchase_cooperative',
        'cattle_sales', 'sale_satisfaction',

        //part7
        'support_sources', 'support_visit', 'production_support', 'cattle_heath_support',
        'training_support', 'observe_support', 'female_breeder_support',
        //part8
    ];

    //relationships to choices

    public function sexes()
    {
        return $this->belongsToMany(Choice::class)->where('type', '=', 'sex');

    }

    public function educations()
    {
        return $this->belongsToMany(Choice::class)->where('type', '=', 'education');

    }

    public function family_statuses()
    {
        return $this->belongsToMany(Choice::class)
            ->withPivot('remark')
            ->where('type', '=', 'family_status');
    }

    public function joptypes()
    {
        return $this->choices()->withPivot('remark')
            ->where('type', '=', 'jobtypes');
        //return $this->belongsToMany(Choice::class)
        //   ->withPivot('remark')
        //  ->where('type', '=', 'jobtypes');
    }

    public function cattle_jobs()
    {
        return $this->belongsToMany(Choice::class)
            ->withPivot('remark')
            ->where('type', '=', 'cattle_job');
    }

    public function social_statuses()
    {
        return $this->belongsToMany(Choice::class)
            ->withPivot('remark')
            ->where('type', '=', 'social_status');

    }

    public function personal_statuses()
    {
        return $this->belongsToMany(Choice::class)
            ->withPivot('remark')
            ->where('type', '=', 'personal_status');
    }

    public function income_ranges()
    {
        return $this->belongsToMany(Choice::class)
            ->where('type', '=', 'income_range');
    }

    public function choices()
    {
        return $this->belongsToMany(Choice::class)->withPivot('remark');
    }

    //part2
    public function farm_purposes()
    {
        //return $this->belongsToMany(Choice::class)
        return $this->choices()
            //return $this->choices2()
            ->withPivot('remark')
            ->where('type', '=', 'farm_purposes');
    }

    public function farm_record()
    {
        return $this->belongsToMany(Choice::class)
            ->where('type', '=', 'farm_record');
        //return $this->choices2()->where('type', '=', 'farm_record');
    }

    public function farm_exp()
    {
        return $this->belongsToMany(Choice::class)
            //return $this->choices2()
            ->where('type', '=', 'farm_exp');

    }

    public function farm_future()
    {
        return $this->belongsToMany(Choice::class)
            //return $this->choices2()
            ->where('type', '=', 'farm_future');

    }

    public function farm_register_status()
    {
        return $this->choices()
            ->where('type', '=', 'farm_register_status');

    }

    public function farm_register()
    {
        return $this->choices()
            ->withPivot('remark')
            ->where('type', '=', 'farm_register');
    }

    public function farm_disease_check()
    {
        return $this->choices()->where('type', '=', 'farm_disease_check');

    }

    public function abortion()
    {
        return $this->choices()->where('type', '=', 'abortion');

    }

    public function tuberculosis()
    {
        return $this->choices()->where('type', '=', 'tuberculosis');

    }

    public function foot_mouth_disease()
    {
        return $this->choices()->where('type', '=', 'foot_mouth_disease');

    }

    public function master_breeding_types()
    {
        return $this->choices()
            //return $this->belongsToMany(Choice::class)
            // ->with(['children'])
            ->where('type', '=', 'master_breeding_types');

    }

    public function male_breeding_types()
    {
        //return $this->choices2()
        return $this->choices()
            // return $this->belongsToMany(Choice::class)
            // ->with('children')
            ->withPivot(['remark', 'source', 'amount', 'price'])
            ->where('type', '=', 'male_breeding_types');
    }

    public function male_int_breeding_types()
    {
        //return $this->choices2()
        return $this->choices()
            //return $this->belongsToMany(Choice::class)
            ->withPivot(['source', 'amount', 'price'])
            ->where('type', '=', 'male_int_breeding_types');
    }

    public function male_mixed_breeding_types()
    {
        // return $this->choices2()
        return $this->choices()
            // return $this->belongsToMany(Choice::class)
            ->withPivot(['source', 'amount', 'price'])
            ->where('type', '=', 'male_mixed_breeding_types');
    }

    public function female_breeding_types()
    {
        //return $this->choices2()
        //return $this->belongsToMany(Choice::class)
        // ->with(['children'])
        return $this->choices()
            ->withPivot(['remark', 'source', 'amount', 'price'])
            ->where('type', '=', 'female_breeding_types');
    }

    public function female_int_breeding_types()
    {
        //return $this->choices2()
        // return $this->belongsToMany(Choice::class)
        return $this->choices()
            ->withPivot(['source', 'amount', 'price'])
            ->where('type', '=', 'female_int_breeding_types');
    }

    public function female_mixed_breeding_types()
    {
        //return $this->choices2()
        return $this->choices()
            // return $this->belongsToMany(Choice::class)
            ->withPivot(['source', 'amount', 'price'])
            ->where('type', '=', 'female_mixed_breeding_types');
    }

    public function male_over_six_breeding_types()
    {
        //return $this->choices2()
        return $this->choices()
            //return $this->belongsToMany(Choice::class)
            // ->with(['children'])
            ->withPivot(['remark', 'source', 'amount', 'price'])
            ->where('type', '=', 'male_over_six_breeding_types');
    }

    public function male_over_six_int_breeding_types()
    {
        return $this->choices()
            //return $this->belongsToMany(Choice::class)
            ->withPivot(['source', 'amount', 'price'])
            ->where('type', '=', 'male_over_six_int_breeding_types');
    }

    public function male_over_six_mixed_breeding_types()
    {
        return $this->choices()
            //    return $this->belongsToMany(Choice::class)
            ->withPivot(['source', 'amount', 'price'])
            ->where('type', '=', 'male_over_six_mixed_breeding_types');
    }

    public function female_over_six_breeding_types()
    {
        return $this->choices()
            // return $this->belongsToMany(Choice::class)
            ->with(['children'])
            ->withPivot(['remark', 'source', 'amount', 'price'])
            ->where('type', '=', 'female_over_six_breeding_types');
    }

    public function female_over_six_int_breeding_types()
    {
        return $this->choices()
            //return $this->belongsToMany(Choice::class)
            ->withPivot(['source', 'amount', 'price'])
            ->where('type', '=', 'female_over_six_int_breeding_types');
    }

    public function female_over_six_mixed_breeding_types()
    {
        return $this->choices()
            // return $this->belongsToMany(Choice::class)
            ->withPivot(['source', 'amount', 'price'])
            ->where('type', '=', 'female_over_six_mixed_breeding_types');
    }

    public function male_under_six_breeding_types()
    {
        return $this->choices()
            //return $this->belongsToMany(Choice::class)
            // ->with(['children'])
            ->withPivot(['remark', 'source', 'amount', 'price'])
            ->where('type', '=', 'male_under_six_breeding_types');
    }

    public function male_under_six_int_breeding_types()
    {
        return $this->choices()
            // return $this->belongsToMany(Choice::class)
            ->withPivot(['source', 'amount', 'price'])
            ->where('type', '=', 'male_under_six_int_breeding_types');
    }

    public function male_under_six_mixed_breeding_types()
    {
        return $this->choices()
            //return $this->belongsToMany(Choice::class)
            ->withPivot(['source', 'amount', 'price'])
            ->where('type', '=', 'male_under_six_mixed_breeding_types');
    }

    public function female_under_six_breeding_types()
    {
        return $this->choices()
            //return $this->belongsToMany(Choice::class)
            ->with(['children'])
            ->withPivot(['remark', 'source', 'amount', 'price'])
            ->where('type', '=', 'female_under_six_breeding_types');
    }

    public function female_under_six_int_breeding_types()
    {
        return $this->choices()
            // return $this->belongsToMany(Choice::class)
            ->withPivot(['source', 'amount', 'price'])
            ->where('type', '=', 'female_under_six_int_breeding_types');
    }

    public function female_under_six_mixed_breeding_types()
    {
        return $this->choices()
            //return $this->belongsToMany(Choice::class)
            ->withPivot(['source', 'amount', 'price'])
            ->where('type', '=', 'female_under_six_mixed_breeding_types');
    }

    //part3

    public function own_land()
    {
        return $this->choices()
            ->withPivot(['remark', 'area'])
            ->where('type', '=', 'own_land');

    }

    public function rent_land()
    {
        return $this->choices()
            ->withPivot(['remark', 'area','price'])
            ->where('type', '=', 'rent_land');

    }

    public function use_land()
    {
        return $this->choices()
            ->withPivot(['remark', 'area'])
            ->where('type', '=', 'use_land');

    }

    public function minerals_feed()
    {
        return $this->choices()->where('type', '=', 'minerals_feed');

    }

    public function feedstock()
    {
        return $this->choices()->where('type', '=', 'feedstock');

    }


    public function water_source_types()
    {
        return $this->choices()
            ->withPivot('remark')
            ->where('type', '=', 'water_source_types');
    }

    public function take_care_types()
    {
        return $this->choices()
            ->where('type', '=', 'take_care_types');
    }

    public function sub_own_lands()
    {
        return $this->choices()
            ->withPivot(['remark', 'area'])
            ->where('type', '=', 'sub_own_lands');
    }

    public function sub_use_lands()
    {
        return $this->choices()
            //->withPivot('area')
            ->withPivot(['remark', 'area'])
            ->where('type', '=', 'sub_use_lands');
    }

    public function feed_types()
    {
        return $this->choices()
            ->where('type', '=', 'feed_types');
    }

    public function feed_sources()
    {
        return $this->choices()
            ->withPivot('remark')
            ->where('type', '=', 'feed_sources');
    }

    public function feedstock_types()
    {
        return $this->choices()
            ->withPivot(['width', 'height', 'amount'])
            ->where('type', '=', 'feedstock_types');
    }

    public function feed_summer_sources()
    {
        return $this->choices()
            ->where('type', '=', 'feed_summer_sources');
    }

    //part4
    public function farm_breeding_type()
    {
        return $this->choices()
            ->where('type', '=', 'farm_breeding_type');
    }
    public function cattle_death()
    {
        return $this->choices()
            ->withPivot('amount')
            ->where('type', '=', 'cattle_death');
    }
    public function dewormed_amount()
    {
        return $this->choices()
            ->withPivot(['remark','amount'])
            ->where('type', '=', 'dewormed_amount');
    }
    public function vaccine_ever()
    {
        return $this->choices()
            ->where('type', '=', 'vaccine_ever');
    }
    public function biogas_status()
    {
        return $this->choices()
            ->where('type', '=', 'biogas_status');
    }
    public function vaccined_by()
    {
        return $this->choices()
            ->where('type', '=', 'vaccined_by');
    }
    
    public function inseminate_sources()
    {
        return $this->choices()
            ->withPivot('remark','price')
            ->where('type', '=', 'inseminate_sources');
    }
    public function breeders()
    {
        return $this->choices()
            ->withPivot('remark')
            ->where('type', '=', 'breeders');
    }
    public function cattle_death_causes()
    {
        return $this->choices()
            ->where('type', '=', 'cattle_death_causes');
    }
    public function disease_cured_by()
    {
        return $this->choices()
            ->withPivot('remark')
            ->where('type', '=', 'disease_cured_by');
    }
    public function cattle_dung_uses()
    {
        return $this->choices()
            ->withPivot('price')
            ->where('type', '=', 'water_source_types');
    }

    //part5
    public function budget_source()
    {
        // return $this->belongsToMany(Choice::class)
        return $this->choices()
            ->withPivot(['amount', 'remark'])
            ->where('type', '=', 'budget_source');

    }

    public function loan_types()
    {
        //return $this->belongsToMany(Choice::class)
        return $this->choices()
            ->withPivot(['remark', 'amount', 'rate'])
            ->where('type', '=', 'loan_types');
    }

    //part6
    public function seller_types()
    {
        //return $this->belongsToMany(Choice::class)
        return $this->choices()
            ->withPivot('remark')
            ->where('type', '=', 'seller_types');
    }

    public function cattle_sale_methods()
    {
        //return $this->belongsToMany(Choice::class)
        return $this->choices()
            ->where('type', '=', 'cattle_sale_methods');
    }

    public function group_joins()
    {
        //return $this->belongsToMany(Choice::class)
        return $this->choices()
            ->withPivot(['remark','joined'])
            ->where('type', '=', 'group_joins');
    }

    public function group_join_future()
    {
        //return $this->belongsToMany(Choice::class)
        return $this->choices()
            ->where('type', '=', 'group_join_future');
    }

    public function cooperative_help_types()
    {
        //return $this->belongsToMany(Choice::class)
        return $this->choices()
            ->withPivot('remark')
            ->where('type', '=', 'cooperative_help_types');
    }

    public function feed_purchase_cooperative()
    {
        //return $this->belongsToMany(Choice::class)
        return $this->choices()
            ->where('type', '=', 'feed_purchase_cooperative');
    }

    public function cattle_sales()
    {
        //return $this->belongsToMany(Choice::class)
        return $this->choices()
            ->withPivot(['remark','duration'])
            ->where('type', '=', 'cattle_sales');
    }

    public function sale_satisfaction()
    {
        //return $this->belongsToMany(Choice::class)
        return $this->choices()
            ->where('type', '=', 'sale_satisfaction');
    }

    //part7
    public function support_sources()
    {
        return $this->choices()
            ->where('type', '=', 'support_sources');
    }

    public function support_visit()
    {
        return $this->choices()
            ->withPivot('remark')
            ->where('type', '=', 'support_visit');

    }

    public function production_support()
    {
        return $this->choices()
            ->withPivot('remark')
            ->where('type', '=', 'production_support');

    }

    public function cattle_heath_support()
    {

        return $this->choices()
            ->withPivot('remark')
            ->where('type', '=', 'cattle_heath_support');

    }

    public function training_support()
    {
        return $this->choices()
            ->withPivot('remark')
            ->where('type', '=', 'training_support');

    }

    public function observe_support()
    {
        return $this->choices()
            ->withPivot('remark')
            ->where('type', '=', 'observe_support');

    }

    public function female_breeder_support()
    {
        return $this->choices()
            ->withPivot('remark')
            ->where('type', '=', 'female_breeder_support');

    }


    //get attributes
    
    public function getPersonalStatusAttribute()
    {
        $obj = $this->personal_statuses()->first();
        if ($obj) {
            return $obj;
        } else {
            return [];
        }
    }

    public function getIncomeRangeAttribute()
    {
        $obj = $this->income_ranges()->first();
        if ($obj) {
            return $obj;
        } else {
            return [];
        }
    }

    public function getCattleJobAttribute()
    {
        $obj = $this->cattle_jobs()->first();
        if ($obj) {
            return $obj;
        } else {
            return [];
        }
    }

    public function getEducationAttribute()
    {
        $obj = $this->educations()->first();
        if ($obj) {
            return $obj;
        } else {
            return [];
        }
    }

    public function getSocialStatusAttribute()
    {
        $obj = $this->social_statuses()->first();
        if ($obj) {
            return $obj;
        } else {
            return [];
        }
    }

    public function getSexAttribute()
    {
        $value = $this->sexes()->first();
        if ($value) {
            return $value;
        } else {
            return [];
        }
    }

    public function getFamilyStatusAttribute()
    {
        $value = $this->family_statuses()->first();
        if ($value) {
            return $value;
        } else {
            return [];
        }
    }

    public function getJobtypesAttribute()
    {
        return $this->joptypes()->get();
    }


    //part 2

    public function getFarmPurposesAttribute()
    {
        return $this->farm_purposes()->get();
    }

    public function getFarmRecordAttribute()
    {
        $obj = $this->farm_record()->first();
        if ($obj) {
            return $obj;
        } else {
            return [];
        }
    }

    public function getFarmExpAttribute()
    {
        $value = $this->farm_exp()->first();
        if ($value) {
            return $value;
        } else {
            return [];
        }
    }

    public function getFarmFutureAttribute()
    {
        $value = $this->farm_future()->first();
        if ($value) {
            return $value;
        } else {
            return [];
        }
    }

    public function getMasterBreedingTypesAttribute()
    {
        return $this->master_breeding_types()->get();
    }

    public function getMaleBreedingTypesAttribute()
    {
        return $this->male_breeding_types()->get();
    }

    public function getMaleIntBreedingTypesAttribute()
    {
        return $this->male_int_breeding_types()->get();
    }

    public function getMaleMixedBreedingTypesAttribute()
    {
        return $this->male_mixed_breeding_types()->get();
    }

    public function getFemaleBreedingTypesAttribute()
    {
        return $this->female_breeding_types()->get();
    }

    public function getFemaleIntBreedingTypesAttribute()
    {
        return $this->female_int_breeding_types()->get();
    }

    public function getFemaleMixedBreedingTypesAttribute()
    {
        return $this->female_mixed_breeding_types()->get();
    }

    public function getMaleOverSixBreedingTypesAttribute()
    {
        return $this->male_over_six_breeding_types()->get();
    }

    public function getMaleOverSixIntBreedingTypesAttribute()
    {
        return $this->male_over_six_int_breeding_types()->get();
    }

    public function getMaleOverSixMixedBreedingTypesAttribute()
    {
        return $this->male_over_six_mixed_breeding_types()->get();
    }

    public function getFemaleOverSixBreedingTypesAttribute()
    {
        return $this->female_over_six_breeding_types()->get();
    }

    public function getFemaleOverSixIntBreedingTypesAttribute()
    {
        return $this->female_over_six_int_breeding_types()->get();
    }

    public function getFemaleOverSixMixedBreedingTypesAttribute()
    {
        return $this->female_over_six_mixed_breeding_types()->get();
    }

    public function getMaleUnderSixBreedingTypesAttribute()
    {
        return $this->male_under_six_breeding_types()->get();
    }

    public function getMaleUnderSixIntBreedingTypesAttribute()
    {
        return $this->male_under_six_int_breeding_types()->get();
    }

    public function getMaleUnderSixMixedBreedingTypesAttribute()
    {
        return $this->male_under_six_mixed_breeding_types()->get();
    }

    public function getFemaleUnderSixBreedingTypesAttribute()
    {
        return $this->female_under_six_breeding_types()->get();
    }

    public function getFemaleUnderSixIntBreedingTypesAttribute()
    {
        return $this->female_under_six_int_breeding_types()->get();
    }

    public function getFemaleUnderSixMixedBreedingTypesAttribute()
    {
        return $this->female_under_six_mixed_breeding_types()->get();
    }


    public function getFarmRegisterStatusAttribute()
    {
        $value = $this->farm_register_status()->first();
        if ($value) {
            return $value;
        } else {
            return [];
        }
    }

    public function getFarmRegisterAttribute()
    {
        $value = $this->farm_register()->first();
        if ($value) {
            return $value;
        } else {
            return [];
        }
    }

    public function getFarmDiseaseCheckAttribute()
    {
        $value = $this->farm_disease_check()->first();
        if ($value) {
            return $value;
        } else {
            return [];
        }
    }

    public function getAbortionAttribute()
    {
        $value = $this->abortion()->first();
        if ($value) {
            return $value;
        } else {
            return [];
        }
    }

    public function getTuberculosisAttribute()
    {
        $value = $this->tuberculosis()->first();
        if ($value) {
            return $value;
        } else {
            return [];
        }
    }

    public function getFootMouthDiseaseAttribute()
    {
        $value = $this->foot_mouth_disease()->first();
        if ($value) {
            return $value;
        } else {
            return [];
        }
    }

    //part 3

    public function getOwnLandAttribute()
    {
        $value = $this->own_land()->first();
        if ($value) {
            return $value;
        } else {
            return [];
        }
    }

    public function getRentLandAttribute()
    {
        $value = $this->rent_land()->first();
        if ($value) {
            return $value;
        } else {
            return [];
        }
    }

    public function getUseLandAttribute()
    {
        $value = $this->use_land()->first();
        if ($value) {
            return $value;
        } else {
            return [];
        }
    }

    public function getMineralsFeedAttribute()
    {
        $value = $this->minerals_feed()->first();
        if ($value) {
            return $value;
        } else {
            return [];
        }
    }

    public function getFeedstockAttribute()
    {
        $value = $this->feedstock()->first();
        if ($value) {
            return $value;
        } else {
            return [];
        }
    }


    public function getWaterSourceTypesAttribute()
    {
        return $this->water_source_types()->get();
    }

    public function getTakeCareTypesAttribute()
    {
        return $this->take_care_types()->get();
    }

    public function getSubOwnLandsAttribute()
    {
        return $this->sub_own_lands()->get();

    }

    public function getSubUseLandsAttribute()
    {
        return $this->sub_use_lands()->get();

    }

    public function getFeedTypesAttribute()
    {
        return $this->feed_types()->get();

    }

    public function getFeedSourcesAttribute()
    {
        return $this->feed_sources()->get();

    }

    public function getFeedstockTypesAttribute()
    {
        return $this->feedstock_types()->get();

    }

    public function getFeedSummerSourcesAttribute()
    {
        return $this->feed_summer_sources()->get();

    }

    //part4
    public function getInseminateSourcesAttribute()
    {
        return $this->inseminate_sources()->get();

    }
    public function getBreedersAttribute()
    {
        return $this->breeders()->get();

    }
    public function getCattleDeathCausesAttribute()
    {
        return $this->cattle_death_causes()->get();

    }
    public function getDiseaseCuredByAttribute()
    {
        return $this->disease_cured_by()->get();

    }
    public function getCattleDungUsesAttribute()
    {
        return $this->cattle_dung_uses()->get();

    }
    
    public function getFarmBreedingTypeAttribute()
    {
        $value = $this->farm_breeding_type()->first();
        if ($value) {
            return $value;
        } else {
            return [];
        }
    }
    public function getCattleDeathAttribute()
    {
        $value = $this->cattle_death()->first();
        if ($value) {
            return $value;
        } else {
            return [];
        }
    }
    public function getDewormedAmountAttribute()
    {
        $value = $this->dewormed_amount()->first();
        if ($value) {
            return $value;
        } else {
            return [];
        }
    }
    public function getVaccineEverAttribute()
    {
        $value = $this->vaccine_ever()->first();
        if ($value) {
            return $value;
        } else {
            return [];
        }
    }
    public function getBiogasStatusAttribute()
    {
        $value = $this->biogas_status()->first();
        if ($value) {
            return $value;
        } else {
            return [];
        }
    }
    public function getVaccinedByAttribute()
    {
        $value = $this->vaccined_by()->first();
        if ($value) {
            return $value;
        } else {
            return [];
        }
    }

    //part5
    public function getBudgetSourceAttribute()
    {
        $value = $this->budget_source()->first();
        if ($value) {
            return $value;
        } else {
            return [];
        }
    }

    public function getLoanTypesAttribute()
    {
        return $this->loan_types()->get();
    }


    //part6
    public function getSellerTypesAttribute()
    {
        return $this->seller_types()->get();
    }

    public function getCattleSaleMethodsAttribute()
    {
        return $this->cattle_sale_methods()->get();
    }

    public function getGroupJoinsAttribute()
    {
        return $this->group_joins()->get();
    }

    public function getGroupJoinFutureAttribute()
    {
        $value = $this->group_join_future()->first();
        if ($value) {
            return $value;
        } else {
            return [];
        }
    }

    public function getCooperativeHelpTypesAttribute()
    {
        return $this->cooperative_help_types()->get();
    }

    public function getFeedPurchaseCooperativeAttribute()
    {
        $value = $this->feed_purchase_cooperative()->first();
        if ($value) {
            return $value;
        } else {
            return [];
        }
    }

    public function getCattleSalesAttribute()
    {
        return $this->cattle_sales()->get();
    }

    public function getSaleSatisfactionAttribute()
    {
        $value = $this->sale_satisfaction()->first();
        if ($value) {
            return $value;
        } else {
            return [];
        }
    }

    //part7
    public function getSupportSourcesAttribute()
    {
        return $this->support_sources()->get();
    }

    public function getSupportVisitAttribute()
    {
        $obj = $this->support_visit()->first();
        if ($obj) {
            return $obj;
        } else {
            return [];
        }
    }

    public function getProductionSupportAttribute()
    {
        $obj = $this->production_support()->first();
        if ($obj) {
            return $obj;
        } else {
            return [];
        }
    }

    public function getCattleHeathSupportAttribute()
    {
        $obj = $this->cattle_heath_support()->first();
        if ($obj) {
            return $obj;
        } else {
            return [];
        }
    }

    public function getTrainingSupportAttribute()
    {
        $obj = $this->training_support()->first();
        if ($obj) {
            return $obj;
        } else {
            return [];
        }
    }

    public function getObserveSupportAttribute()
    {
        $obj = $this->observe_support()->first();
        if ($obj) {
            return $obj;
        } else {
            return [];
        }
    }

    public function getFemaleBreederSupportAttribute()
    {
        $obj = $this->female_breeder_support()->first();
        if ($obj) {
            return $obj;
        } else {
            return [];
        }
    }


}