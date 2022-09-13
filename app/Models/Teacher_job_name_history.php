<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher_job_name_history extends Model
{

    protected $fillable = [
        'job_name_id','teacher_id'
    ];

    public function Teacher(){
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }

    public function Job_name(){
        return $this->belongsTo(Job_name::class, 'job_name_id');
    }
}
