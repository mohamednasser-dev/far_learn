<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $guarded = [];
    protected $hidden = ['deleted','created_at','updated_at'];
    public function Episode(){
        return $this->belongsTo(Episode::class, 'episode_id');
    }
    public function Student(){
        return $this->belongsTo(Student::class, 'student_id');
    }
    public function Teacher(){
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }
}
