<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Created by PhpStorm.
 * User: chaow
 * Date: 5/25/2016
 * Time: 3:50 PM
 */
class Choice extends Model
{
    protected $fillable = ['choice', 'type'];

    protected $appends = ['children'];

    public function children()
    {
        return $this->hasMany(Choice::class, 'parent_id')->orderBy('order','asc');
    }

    public function parent()
    {
        return $this->hasOne(Choice::class, 'parent_id');
    }

    public function getChildrenAttribute()
    {
        return $this->children()->get();
    }
}