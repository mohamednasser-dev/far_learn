<?php

namespace App\Models\Plan;

use Illuminate\Database\Eloquent\Model;

class Plan_week extends Model
{
    protected $fillable = [
        'name_ar', 'name_en'
    ];

    protected $appends = ['name'];

    public function getNameAttribute()
    {
        if ($locale = \app()->getLocale() == "ar") {
            return $this->name_ar;
        } else {
            return $this->name_en;
        }
    }
}
