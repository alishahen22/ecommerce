<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    public function getSmallTitleAttribute()
    {
        if (session()->has('locale') && session()->get('locale') == 'ar') {
           return $this->small_title_ar;
        } else {
            return $this->small_title_en;
        }

    }
    public function getBigTitleAttribute()
    {
        return session()->has('locale') && session()->get('locale') == 'ar' ? $this->big_title_ar : $this->big_title_en;
    }
}
