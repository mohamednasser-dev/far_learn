<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student_attendance extends Model
{
    protected $fillable = [
        'student_id', 'episode_id','section_id'
    ];

    public function Episode()
    {
        return $this->belongsTo(Episode::class, 'episode_id');
    }

    public function Section()
    {
        return $this->belongsTo(Episode_section::class, 'section_id');
    }

    public function Student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}
