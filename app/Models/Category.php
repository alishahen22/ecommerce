<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    //فانكشن اللى بترجع العلاقة بين الكاتيجورى والبرودكت
    public function products(){
        return $this->hasMany(Product::class);
    }

    public function getTitleAttribute()
    {
        return session()->has('locale') && session()->get('locale') == 'ar' ? $this->title_ar : $this->title_en;
    }


}
