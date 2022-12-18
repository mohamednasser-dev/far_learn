<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Episode_rate_question extends Model
{
    protected $guarded = [];
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
