<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Episode_section extends Model
{
    protected $fillable = [
        'episode_id', 'epo_link','epo_date','start_time','end_time','status','come_num','long_time_fifteen','long_time_thirty'
    ];
    public function Episode()
    {
        return $this->belongsTo(Episode::class, 'episode_id');
    }
}
