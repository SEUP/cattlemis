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

    public function social_statuses()
    {
        return $this->belongsToMany(Choice::class)
            ->withPivot('remark')
            ->where('type', '=', 'social_status');

    }

    public function choices()
    {
        return $this->belongsToMany(Choice::class)->withPivot('remark');
    }

    protected $hidden = ['sexes', 'family_statuses', 'choices', 'educations'];

    protected $appends = ['sex', 'family_status', 'education', 'social_status'];

    public function getEducationAttribute()
    {
        $value = $this->educations->first();
        return $value;
    }

    public function getSocialStatusAttribute()
    {
        return $this->social_statuses()->first();
    }

    public function getSexAttribute()
    {
        $value = $this->sexes->first();
        if ($value) {
            return $value;
        } else {
            return [
                'id' => '0'
            ];
        }
    }

    public function getFamilyStatusAttribute()
    {
        $value = $this->family_statuses->first();
        if ($value) {
            return $value;
        } else {
            return [
                'id' => '0'
            ];
        }
    }
}