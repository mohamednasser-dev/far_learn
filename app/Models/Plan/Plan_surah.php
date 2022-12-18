<?php

namespace App\Models\Plan;

use Illuminate\Database\Eloquent\Model;

class Plan_surah extends Model
{
    protected $fillable = [
        'name_ar', 'name_en','deleted','ayat_num'
    ];

    protected $appends = ['name'];
    public function getNameAttribute()
    {
        if (\app()->getLocale() == "ar") {
            return $this->name_ar;
        } else {
            return $this->name_en;
        }
    }
}
