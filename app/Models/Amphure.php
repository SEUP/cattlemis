<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Created by PhpStorm.
 * User: chaow
 * Date: 5/25/2016
 * Time: 3:50 PM
 */
class Amphure extends Model
{
    protected  $table = "thailand_amphures";
    
    public function province()
    {
        return $this->belongsTo(Province::class);
    }


}
