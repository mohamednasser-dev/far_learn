<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Episode_day extends Model
{
    protected $fillable = [
        'episode_id', 'day_id'
    ];
    public function Episode()
    {
        return $this->belongsTo(Episode::class, 'episode_id');
    }

    public function Day()
    {
        return $this->belongsTo(day::class, 'day_id');
    }
}
