<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher_absence extends Model
{

    protected $fillable = [
        'teacher_id','absence_date','type','episode_id','reason'
    ];

    public function Teacher(){
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }
    public function Episode(){
        return $this->belongsTo(Episode::class, 'episode_id')->withDefault(
            ['name_ar'=>'','name_en'=>'']
        );
    }
}
