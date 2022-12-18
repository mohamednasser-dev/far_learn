<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student_level_history extends Model
{
    protected $fillable = [
        'student_id', 'level_id','subject_id','subject_level_id','notes_ar','notes_en'
    ];

    protected $appends = ['notes'];
    public function getNotesAttribute()
    {
        if (\app()->getLocale() == "ar") {
            return $this->notes_ar ;
        } else {
            return $this->notes_en;
        }
    }

    public function Student()
    {
        return $this->belongsTo(Student::class, 'student_id');
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
