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
        'house_province',
        'house_district',
        'house_suburb',
        'house_postcode',
        'house_phone',
        'mobile_no',
        'email',
        'farm_name',
        'farm_no',
        'farm_moo',
        'farm_province',
        'farm_district',
        'farm_suburb',
        'farm_lat',
        'farm_long',
        'age',
        'avg_cattle_income',
    ];

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

    protected $hidden = ['sexes', 'family_statuses', 'choices', 'educations', 'cattle_jobs', 'income_ranges'];

    protected $appends = ['sex', 'family_status', 'education', 'social_status', 'personal_status', 'cattle_job', 'income_range'];

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
}