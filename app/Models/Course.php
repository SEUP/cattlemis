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
class Course extends Model
{

    protected $fillable = ["code", "name", "semester", "year", "description"];


    function user()
    {
        return $this->belongsTo(User::class);
    }

    function homeworks()
    {
        return $this->hasMany(Homework::class);
    }

    function students()
    {
        return $this->belongsToMany(User::class, 'course_student');
    }
}