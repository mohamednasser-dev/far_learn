<?php

namespace App\Models;

use App\Models\Plan\Plan_day;
use App\Models\Plan\Plan_surah;
use App\Models\Plan\Plan_week;
use Illuminate\Database\Eloquent\Model;

class Student_Questions_episode extends Model
{
    protected $fillable = [
        'student_id', 'episode_id', 'episode_course_id', 'from_surah_id', 'from_num', 'to_surah_id', 'to_num'
    ];

    public function From_Surah()
    {
        return $this->belongsTo(Plan_surah::class, 'from_surah_id');
    }

    public function Episode()
    {
        return $this->belongsTo(Episode::class, 'episode_id');
    }

    public function To_Surah()
    {
        return $this->belongsTo(Plan_surah::class, 'to_surah_id');
    }
}
