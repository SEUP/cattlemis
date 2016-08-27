<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Created by PhpStorm.
 * User: chaow
 * Date: 5/25/2016
 * Time: 3:50 PM
 */
class Amphur extends Model
{
    protected $table = "thailand_amphures";


    protected $primaryKey = 'AMPHUR_ID';

    public function districts()
    {
        return $this->hasMany(District::class, "AMPHUR_ID", "AMPHUR_ID");
    }
}

