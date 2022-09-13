<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $fillable = [
        'name_ar', 'name_en','deleted','city_id'
    ];
    protected $hidden = ['deleted','created_at','updated_at'];
    protected $appends = ['name'];
    public function getNameAttribute()
    {
        if ($locale = \app()->getLocale() == "ar") {
            return $this->name_ar ;
        } else {
            return $this->name_en;
        }
    }

    public function City()
    {
        return $this->belongsTo(City::class, 'city_id');
    }
}
