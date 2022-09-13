<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class day extends Model
{
    protected $fillable = [
        'name_ar', 'name_en'
    ];

    protected $appends = ['name'];
    protected $hidden = ['pivot','created_at','updated_at'];

    public function getNameAttribute()
    {
        if ($locale = \app()->getLocale() == "ar") {
            return $this->name_ar;
        } else {
            return $this->name_en;
        }
    }

    public function Episode()
    {
        return $this->belongsToMany(Episode::class, 'episode_days', 'day_id', 'episode_id');
    }
}
