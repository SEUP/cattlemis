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
        'house_district', 'house_suburb', 'house_postcode', 'house_phone', 'mobile_no', 'email',
        'farm_name', 'farm_no', 'farm_moo', 'farm_province', 'farm_district', 'farm_suburb',
        'farm_lat', 'farm_long', 'age', 'avg_cattle_income',

    ];

    protected $hidden = [
        'sexes', 'family_statuses', 'choices', 'educations', 'cattle_jobs', 'income_ranges'
    ];

    protected $appends = [
        'sex', 'family_status', 'education', 'social_status', 'personal_status', 'cattle_job', 'income_range',
        'jobtypes', 'farm_purposes','farm_record',
        'farm_exp','farm_future','farm_register_status','farm_register' ,'farm_disease_check',
        'abortion','tuberculosis','foot_mouth_disease', 'master_breeding_types', 'male_breeding_types',
        'male_int_breeding_types','male_mixed_breeding_types', 'female_breeding_types' ,
        'female_int_breeding_types', 'female_mixed_breeding_types', 'male_over_six_breeding_types',
        'male_over_six_int_breeding_types', 'male_over_six_mixed_breeding_types',
        'female_over_six_breeding_types', 'female_over_six_int_breeding_types',
        'female_over_six_mixed_breeding_types', 'male_under_six_breeding_types',
        'male_under_six_int_breeding_types', 'male_under_six_mixed_breeding_types',
        'female_under_six_breeding_types', 'female_under_six_int_breeding_types',
        'female_under_six_mixed_breeding_types'
    ];


    //parts

    public function farm_info()
    {
        return $this->hasOne(FarmInfo::class);
    }


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
        return $this->belongsToMany(Choice::class)
            ->withPivot('remark')
            ->where('type', '=', 'jobtypes');
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
            ->withPivot('remark')
            ->where('type', '=', 'income_range');
    }

    public function choices()
    {
        return $this->belongsToMany(Choice::class)->withPivot('remark');
    }

    public function choices2()
    {
        return $this->belongsToMany(Choice::class, "choice_farm_info")
            ->withPivot(['remark', 'amount', 'price', 'source', 'price']);
    }

    public function farm_purposes()
    {
        return $this->choices2()
            ->withPivot('remark')
            ->where('type', '=', 'farm_purposes');
    }

    public function farm_record()
    {
        return $this->belongsToMany(Choice::class)->where('type', '=', 'farm_record');

    }

    public function farm_exp()
    {
        return $this->belongsToMany(Choice::class)->where('type', '=', 'farm_exp');

    }

    public function farm_future()
    {
        return $this->belongsToMany(Choice::class)->where('type', '=', 'farm_future');

    }

    public function farm_register_status()
    {
        return $this->belongsToMany(Choice::class)->where('type', '=', 'farm_register_status');

    }

    public function farm_register()
    {
        return $this->belongsToMany(Choice::class)
            ->withPivot('remark')
            ->where('type', '=', 'farm_register');
    }

    public function farm_disease_check()
    {
        return $this->belongsToMany(Choice::class)->where('type', '=', 'farm_disease_check');

    }

    public function abortion()
    {
        return $this->belongsToMany(Choice::class)->where('type', '=', 'abortion');

    }

    public function tuberculosis()
    {
        return $this->belongsToMany(Choice::class)->where('type', '=', 'tuberculosis');

    }

    public function foot_mouth_disease()
    {
        return $this->belongsToMany(Choice::class)->where('type', '=', 'foot_mouth_disease');

    }

    public function master_breeding_types()
    {
        return $this->choices2()->where('type', '=', 'master_breeding_types');

    }

    public function male_breeding_types()
    {
        return $this->choices2()
            ->with(['children'])
            ->withPivot(['remark','source','amount','price'])
            ->where('type', '=', 'male_breeding_types');
    }

    public function male_int_breeding_types()
    {
        return $this->choices2()
            ->withPivot('source')
            ->withPivot('amount')
            ->withPivot('price')
            ->where('type', '=', 'male_int_breeding_types');
    }

    public function male_mixed_breeding_types()
    {
        return $this->choices2()
            ->withPivot('source')
            ->withPivot('amount')
            ->withPivot('price')
            ->where('type', '=', 'male_mixed_breeding_types');
    }

    public function female_breeding_types()
    {
        return $this->choices2()
            ->withPivot('remark')
            ->withPivot('source')
            ->withPivot('amount')
            ->withPivot('price')
            ->where('type', '=', 'female_breeding_types');
    }

    public function female_int_breeding_types()
    {
        return $this->choices2()
            ->withPivot('source')
            ->withPivot('amount')
            ->withPivot('price')
            ->where('type', '=', 'female_int_breeding_types');
    }

    public function female_mixed_breeding_types()
    {
        return $this->choices2()
            ->withPivot('source')
            ->withPivot('amount')
            ->withPivot('price')
            ->where('type', '=', 'female_mixed_breeding_types');
    }

    public function male_over_six_breeding_types()
    {
        return $this->choices2()
            ->withPivot('remark')
            ->withPivot('source')
            ->withPivot('amount')
            ->withPivot('price')
            ->where('type', '=', 'male_over_six_breeding_types');
    }

    public function male_over_six_int_breeding_types()
    {
        return $this->choices2()
            ->withPivot('source')
            ->withPivot('amount')
            ->withPivot('price')
            ->where('type', '=', 'male_over_six_int_breeding_types');
    }

    public function male_over_six_mixed_breeding_types()
    {
        return $this->choices2()
            ->withPivot('source')
            ->withPivot('amount')
            ->withPivot('price')
            ->where('type', '=', 'male_over_six_mixed_breeding_types');
    }

    public function female_over_six_breeding_types()
    {
        return $this->choices2()
            ->withPivot('remark')
            ->withPivot('source')
            ->withPivot('amount')
            ->withPivot('price')
            ->where('type', '=', 'female_over_six_breeding_types');
    }

    public function female_over_six_int_breeding_types()
    {
        return $this->choices2()
            ->withPivot('source')
            ->withPivot('amount')
            ->withPivot('price')
            ->where('type', '=', 'female_over_six_int_breeding_types');
    }

    public function female_over_six_mixed_breeding_types()
    {
        return $this->choices2()
            ->withPivot('source')
            ->withPivot('amount')
            ->withPivot('price')
            ->where('type', '=', 'female_over_six_mixed_breeding_types');
    }

    public function male_under_six_breeding_types()
    {
        return $this->choices2()
            ->withPivot('remark')
            ->withPivot('source')
            ->withPivot('amount')
            ->withPivot('price')
            ->where('type', '=', 'male_under_six_breeding_types');
    }

    public function male_under_six_int_breeding_types()
    {
        return $this->choices2()
            ->withPivot('source')
            ->withPivot('amount')
            ->withPivot('price')
            ->where('type', '=', 'male_under_six_int_breeding_types');
    }

    public function male_under_six_mixed_breeding_types()
    {
        return $this->choices2()
            ->withPivot('source')
            ->withPivot('amount')
            ->withPivot('price')
            ->where('type', '=', 'male_under_six_mixed_breeding_types');
    }

    public function female_under_six_breeding_types()
    {
        return $this->choices2()
            ->withPivot('remark')
            ->withPivot('source')
            ->withPivot('amount')
            ->withPivot('price')
            ->where('type', '=', 'female_under_six_breeding_types');
    }

    public function female_under_six_int_breeding_types()
    {
        return $this->choices2()
            ->withPivot('source')
            ->withPivot('amount')
            ->withPivot('price')
            ->where('type', '=', 'female_under_six_int_breeding_types');
    }

    public function female_under_six_mixed_breeding_types()
    {
        return $this->choices2()
            ->withPivot('source')
            ->withPivot('amount')
            ->withPivot('price')
            ->where('type', '=', 'female_under_six_mixed_breeding_types');
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
        $obj = $this->educations->first();
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
        $value = $this->sexes->first();
        if ($value) {
            return $value;
        } else {
            return [];
        }
    }

    public function getFamilyStatusAttribute()
    {
        $value = $this->family_statuses->first();
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
    
}