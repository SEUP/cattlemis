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
class User extends Authenticatable
{

    protected $fillable = ["firstname", "lastname", "email"];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function facebook()
    {
        return $this->hasOne(FacebookProfile::class);
    }

    public function calendars()
    {
        return $this->hasMany(Calendar::class);
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function isAdmin()
    {
        $role = $this->roles()->where("key", '=', 'admin')->first();
        if ($role) {
            return true;
        } else {
            return false;
        }
    }

}