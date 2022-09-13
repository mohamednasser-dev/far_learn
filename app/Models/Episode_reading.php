<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Episode_reading extends Model
{
    protected $fillable = [
        'episode_id', 'reading_id'
    ];

    public function Episode()
    {
        return $this->belongsTo(Episode::class, 'episode_id');
    }

    public function Reading()
    {
        return $this->belongsTo(Reading::class, 'reading_id');
    }
}
