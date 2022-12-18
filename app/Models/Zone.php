<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{

    protected $fillable = [
        'name_ar', 'name_en','deleted','country_id'
    ];
    protected $hidden = ['deleted','created_at','updated_at'];
    protected $appends = ['name'];
    public function getNameAttribute()
    {
        if (\app()->getLocale() == "ar") {
            return $this->name_ar ;
        } else {
            return $this->name_en;
        }
    }

    public function Country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }
}
