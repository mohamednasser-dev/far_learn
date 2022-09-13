<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher_rate extends Model
{
    protected $fillable = [
        'rate','student_id','teacher_id'
    ];
}
