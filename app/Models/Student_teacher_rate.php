<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student_teacher_rate extends Model
{
    protected $guarded = [];
    public function Teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }
    public function Student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
    public function Episode()
    {
        return $this->belongsTo(Episode::class, 'episode_id');
    }
    public function Section()
    {
        return $this->belongsTo(Episode_section::class, 'section_id');
    }
}
