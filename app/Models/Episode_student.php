<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Episode_student extends Model
{
    protected $fillable = [
        'student_id', 'episode_id','status','student_view','order_num',
        'finish','attendance_rate','level_id','subject_id','subject_level_id'
    ];

    public function Episode()
    {
        return $this->belongsTo(Episode::class, 'episode_id')->where('deleted','0')->where('active','y');
    }

    public function Student()
    {
        return $this->belongsTo(Student::class, 'student_id')->withDefault(
            ['user_name'=>'',]
        );
    }

    public function Level()
    {
        return $this->belongsTo(Level::class, 'level_id');
    }
    public function Subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }
    public function Subject_level()
    {
        return $this->belongsTo(Subject_level::class, 'subject_level_id');
    }

}
