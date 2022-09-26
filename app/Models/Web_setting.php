<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Web_setting extends Model
{
    protected $guarded = [];
    protected $appends = ['address','logo','terms'];

    public function getLogoArAttribute($img)
    {
        if ($img)
            return asset('/uploads/logo') . '/' . $img;
        else
            return "";
    }

    public function getLogoEnAttribute($img)
    {
        if ($img)
            return asset('/uploads/logo') . '/' . $img;
        else
            return "";
    }

    public function getAddressAttribute()
    {
        if ($locale = \app()->getLocale() == "ar") {
            return $this->address_ar;
        } else {
            return $this->address_en;
        }
    }
    public function getLogoAttribute()
    {
        if ($locale = \app()->getLocale() == "ar") {
            return $this->logo_ar;
        } else {
            return $this->logo_en;
        }
    }
    public function getTermsAttribute()
    {
        if ($locale = \app()->getLocale() == "ar") {
            return $this->terms_ar;
        } else {
            return $this->terms_en;
        }
    }
}
