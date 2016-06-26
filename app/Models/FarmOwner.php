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
        return $this->belongsToMany(Choice::class)
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


    protected $hidden = [
        'sexes', 'family_statuses', 'choices', 'educations', 'cattle_jobs', 'income_ranges'
    ];

    protected $appends = [
        'sex', 'family_status', 'education', 'social_status', 'personal_status', 'cattle_job', 'income_range',
        'jobtypes'
    ];

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


}