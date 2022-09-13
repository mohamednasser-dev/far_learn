<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject_level extends Model
{
    protected $fillable = [
        'name_ar', 'name_en','desc_ar','desc_en','subject_id','deleted','num_ayat','num_lines','num_faces'
    ];
    public function Subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }
}
