<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reading extends Model
{
    protected $fillable = [
        'name_ar', 'name_en'
    ];

    protected $appends = ['name'];
    public function getNameAttribute()
    {
        if (\app()->getLocale() == "ar") {
            return $this->name_ar ;
        } else {
            return $this->name_en;
        }
    }
    public function Episode()
    {
        return $this->belongsToMany(Episode::class, 'episode_days', 'reading_id', 'episode_id');
    }
}
