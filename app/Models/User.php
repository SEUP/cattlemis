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

    protected $guarded = ['password'];
    protected $fillable = ["firstname", "lastname", "email", "user_province","user_amphur",'user_district'];


    public function province()
    {
        return $this->belongsTo(Province::class, 'user_province');
    }

    public function amphur()
    {
        return $this->belongsTo(Amphur::class, 'user_amphur');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'user_district');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
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

    public function hasRole($roles)
    {

        if (is_array($roles)) {
            foreach ($roles as $need_role) {
                if ($this->checkIfUserHasRole($need_role)) {
                    return true;
                }
            }
        } else {
            return $this->checkIfUserHasRole($roles);
        }
        return false;
    }

    private function getUserRole()
    {
        return $this->roles()->getResults();
    }

    private function checkIfUserHasRole($need_role)
    {
        return $this->roles()->where('key', '=', $need_role)->first();
    }

}