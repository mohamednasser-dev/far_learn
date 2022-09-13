<?php

namespace App\Models;

use App\Models\Plan\Plan_new;
use App\Models\Plan\Plan_revision;
use App\Models\Plan\Plan_tracomy;
use Illuminate\Database\Eloquent\Model;

class Plan_episode_day extends Model
{
    protected $fillable = [
        'episode_id', 'plan_id','plan_type','section_date','started_at','notify_at','send_status'
    ];

    public function Episode()
    {
        return $this->belongsTo(Episode::class, 'episode_id');
    }

    public function Plan_new()
    {
        return $this->belongsTo(Plan_new::class, 'plan_id');
    }
    public function Plan_tracomy()
    {
        return $this->belongsTo(Plan_tracomy::class, 'plan_id');
    }
    public function Plan_revision()
    {
        return $this->belongsTo(Plan_revision::class, 'plan_id');
    }
}
