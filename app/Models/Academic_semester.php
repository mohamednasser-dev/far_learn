<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Academic_year;
class Academic_semester extends Model
{
    protected $fillable = [
        'name','from', 'to', 'academic_year_id'
    ];

    public function Year()
    {
        return $this->belongsTo(Academic_year::class, 'academic_year_id');
    }
}
