<?php

namespace App\Models;


use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

/**
 * Created by PhpStorm.
 * User: chaow
 * Date: 5/25/2016
 * Time: 3:50 PM
 */
class Homework extends Model
{

    protected $fillable = ["title", "description"];


    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}