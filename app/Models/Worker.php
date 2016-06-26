<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Created by PhpStorm.
 * User: chaow
 * Date: 5/25/2016
 * Time: 3:50 PM
 */
class Worker extends Model
{
    protected $fillable = [
        //part 1
       'farm_owner_id','worker_amount','family_worker_amount','external_worker_amount','total_own_land',
        'total_rent_land'
        //part2
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
