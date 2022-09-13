<?php

namespace App\Models\Plan;

use App\Models\Subject_level;
use Illuminate\Database\Eloquent\Model;

class Plan_revision extends Model
{
    protected $fillable = [
       'week_id', 'day_id','from_surah_id','from_num','to_surah_id','to_num','sub_level_id','deleted'
    ];
    public function Week()
    {
        return $this->belongsTo(Plan_week::class, 'week_id');
    }
    public function Day()
    {
        return $this->belongsTo(Plan_day::class, 'day_id');
    }
    public function From_Surah()
    {
        return $this->belongsTo(Plan_surah::class, 'from_surah_id');
    }
    public function To_Surah()
    {
        return $this->belongsTo(Plan_surah::class, 'to_surah_id');
    }
    public function SubjectLevel()
    {
        return $this->belongsTo(Subject_level::class, 'sub_level_id');
    }
}
