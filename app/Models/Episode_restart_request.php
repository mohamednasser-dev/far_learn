<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Episode_restart_request extends Model
{
    protected $fillable = [
        'teacher_id', 'section_id','status','admin_view'
    ];

    public function Teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }

    public function Section()
    {
        return $this->belongsTo(Episode_section::class, 'section_id');
    }
}
