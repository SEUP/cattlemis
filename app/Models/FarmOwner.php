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
        'farm_lat', 'farm_long', 'age', 'avg_cattle_income' ,

        //part2
        'drug_price', 'food_price', 'expense_remark', 'expense_price',
        'total_master_breeding_types', 'total_male_breeding_types',
        'total_female_breeding_types', 'total_male_over_six_breeding_types',
        'total_female_over_six_breeding_types',
        'total_male_under_six_breeding_types', 'total_female_under_six_breeding_types',
        'total_expense_amount',

        //part3
       // 'total_workers_amount','family_workers_amount','external_workers_amount','total_own_lands',
       // 'total_use_lands',
        
        //part5
        'total_budjet',
        
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
         //'farm_register',
        'farm_disease_check',
        'abortion', 'tuberculosis', 'foot_mouth_disease',
        
        //part3
       // 'water_source_types','take_care_types','own_land','sub_own_lands',
        
        //part5
        'budget_sources','loan_types',
        
        //part7
        'support_sources','support_visit','production_support','cattle_heath_support',
        'training_support','observe_support','female_breeder_support',
       //part8
    ];

    //parts

  /*  public function farm_info()
    {
        return $this->hasOne(FarmInfo::class);
    }*/

    
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

   /* public function choices2()
    {
        return $this->belongsToMany(Choice::class, "choice_farm_info")
            ->withPivot(['remark', 'amount', 'source', 'price']);
    }
*/
    //part2
    public function farm_purposes()
    {
        return $this->belongsToMany(Choice::class)
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
    
       /* public function farm_register()
        {
            return $this->choices()
                ->where('type', '=', 'farm_register');
        }*/

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
            ->withPivot(['source','amount','price'])
            ->where('type', '=', 'male_int_breeding_types');
    }

    public function male_mixed_breeding_types()
    {
       // return $this->choices2()
        return $this->choices()
        // return $this->belongsToMany(Choice::class)
            ->withPivot(['source','amount','price'])
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
            ->withPivot(['source','amount','price'])
            ->where('type', '=', 'female_int_breeding_types');
    }

    public function female_mixed_breeding_types()
    {
        //return $this->choices2()
        return $this->choices()
        // return $this->belongsToMany(Choice::class)
            ->withPivot(['source','amount','price'])
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
            ->withPivot(['source','amount','price'])
            ->where('type', '=', 'male_over_six_int_breeding_types');
    }

    public function male_over_six_mixed_breeding_types()
    {
        return $this->choices()
        //    return $this->belongsToMany(Choice::class)
            ->withPivot(['source','amount','price'])
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
            ->withPivot(['source','amount','price'])
            ->where('type', '=', 'female_over_six_int_breeding_types');
    }

    public function female_over_six_mixed_breeding_types()
    {
        return $this->choices()
       // return $this->belongsToMany(Choice::class)
            ->withPivot(['source','amount','price'])
            ->where('type', '=', 'female_over_six_mixed_breeding_types');
    }

    public function male_under_six_breeding_types()
    {
        return $this->choices()
        //return $this->belongsToMany(Choice::class)
           // ->with(['children'])
            ->withPivot(['remark','source','amount','price'])
            ->where('type', '=', 'male_under_six_breeding_types');
    }

    public function male_under_six_int_breeding_types()
    {
        return $this->choices()
       // return $this->belongsToMany(Choice::class)
            ->withPivot(['source','amount','price'])
            ->where('type', '=', 'male_under_six_int_breeding_types');
    }

    public function male_under_six_mixed_breeding_types()
    {
        return $this->choices()
        //return $this->belongsToMany(Choice::class)
            ->withPivot(['source','amount','price'])
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
            ->withPivot(['source','amount','price'])
            ->where('type', '=', 'female_under_six_int_breeding_types');
    }

    public function female_under_six_mixed_breeding_types()
    {
        return $this->choices()
        //return $this->belongsToMany(Choice::class)
            ->withPivot(['source','amount','price'])
            ->where('type', '=', 'female_under_six_mixed_breeding_types');
    }

    //part3

  /*  public function water_source_types()
    {
        return $this->choices3()
            ->withPivot('remark')
            ->where('type', '=', 'water_source_types');
    }

    public function take_care_types()
    {
        return $this->choices3()
            ->where('type', '=', 'take_care_types');
    }

    public function own_land()
    {
        return $this->choices3()->where('type', '=', 'own_land');

    }

    public function sub_own_lands()
    {
        return $this->choices3()
            ->withPivot('area')
            ->where('type', '=', 'sub_own_lands');
    }*/

    //part5
    public function budget_sources()
    {
       // return $this->belongsToMany(Choice::class)
            return $this->choices()
            ->withPivot('remark')
            ->where('type', '=', 'budget_sources');


    }

    public function loan_types()
    {
        //return $this->belongsToMany(Choice::class)
            return $this->choices()
            ->withPivot(['remark','amount','rate'])
            ->where('type', '=', 'loan_types');
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
            ->where('type', '=', 'support_visit');

    }
    public function production_support()
    {
        return $this->choices()
            ->where('type', '=', 'production_support');

    }
    public function cattle_heath_support()
    {
        
        return $this->choices()
            ->where('type', '=', 'cattle_heath_support');

    }
    public function training_support()
    {
        return $this->choices()
            ->where('type', '=', 'training_support');

    }
    public function observe_support()
    {
        return $this->choices()
            ->where('type', '=', 'observe_support');

    }
    public function female_breeder_support()
    {
        return $this->choices()
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

  /*  public function getFarmInfoAttribute()
    {
        $farmInfo = $this->farm_info()->first();
        if ($farmInfo) {
            return $farmInfo;
        } else {
            $farmInfo = new FarmInfo();
            if ($this->id) {
                $this->farm_info()->save($farmInfo);
            }

            return $farmInfo;
        }
    }*/

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
    
       /* public function getFarmRegisterAttribute()
        {
            return $this->farm_register()->first();
        }*/
    
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
/*
    public function getWaterSourceTypesAttribute()
    {
        return $this->water_source_types()->get();
    }

    public function getTakeCareTypesAttribute()
    {
        return $this->take_care_types()->get();
    }

    public function getOwnLandAttribute()
    {
        $value = $this->own_land()->first();
        if ($value) {
            return $value;
        } else {
            return [];
        }
    }

    public function getSubOwnLandsAttribute()
    {
        return $this->sub_own_lands()->first();

    }

*/

    //part5

    public function getBudgetSourcesAttribute()
    {
        return $this->budget_sources()->get();
    }

    public function getLoanTypesAttribute()
    {
        return $this->loan_types()->get();
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