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
class CalendarEvent extends Model
{
    protected $fillable = ['title', 'description', 'start', 'end','allday'];

    public function calendar()
    {
        return $this->belongsTo(Calendar::class);
    }

}