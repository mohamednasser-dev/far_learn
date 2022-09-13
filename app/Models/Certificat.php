<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certificat extends Model
{
    protected $guarded = [];

    public function Episode()
    {
        return $this->belongsTo(Episode::class, 'episode_id');
    }

    public function Student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
    public function getImageAttribute($image)
    {
        if (!empty($image)) {
            return asset('uploads/certificate') . '/' . $image;
        }
    }

    public function getPdfAttribute($pdf)
    {
        if (!empty($pdf)) {
            return asset('uploads/certificate') . '/' . $pdf;
        }
    }
}
