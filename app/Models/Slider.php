<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $fillable = [
        'image', 'title_ar','title_en','desc_ar','desc_en'
    ];
    protected $appends = ['title', 'description'];

    public function getImageAttribute($img)
    {
        if ($img)
            return asset('/uploads/sliders') . '/' . $img;
        else
            return "";
    }


    public function getTitleAttribute()
    {
        if (\app()->getLocale() == "ar") {
            return $this->title_ar;
        } else {
            return $this->title_en;
        }
    }
    public function getDescriptionAttribute()
    {
        if (\app()->getLocale() == "ar") {
            return $this->desc_ar;
        } else {
            return $this->desc_en;
        }
    }
}
