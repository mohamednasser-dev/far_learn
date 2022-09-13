<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student_section_evaluation extends Model
{
    protected $fillable = [
        'student_id', 'section_id','errors','status','errortype_id'
    ];

}
