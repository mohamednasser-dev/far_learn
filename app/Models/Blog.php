<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        'image', 'title_ar','title_en','desc_ar','desc_en'
    ];

    public function getImageAttribute($img)
    {
        if ($img)
            return asset('/uploads/blogs') . '/' . $img;
        else
            return "";
    }
}
