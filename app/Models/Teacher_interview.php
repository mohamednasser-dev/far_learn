<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher_interview extends Model
{

    protected $fillable = [
        'teacher_id','interview_date','interview_time','selected_date','meeting_id','topic','agenda','start_time','passcode','join_url'
    ];

    public function Teacher(){
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }
}
