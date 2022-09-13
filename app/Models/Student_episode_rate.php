<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student_episode_rate extends Model
{
    protected $guarded = [];

    public function Question()
    {
        return $this->belongsTo(Episode_rate_question::class, 'questions_id');
    }

    public function Episode()
    {
        return $this->belongsTo(Episode::class, 'episode_id')->withDefault([
        'name_ar'=>'','name_en'=>'',
    ]);
    }

    public function Student()
    {
        return $this->belongsTo(Student::class, 'student_id')->withDefault([
            'user_name'=>'',
        ]);
    }

    public function Teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id')->withDefault([
            'user_name'=>'',
        ]);
    }
}
