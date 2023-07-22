<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    function category(){
        return $this->belongsTo(Category::class);
    }

    function tags(){
        return $this->belongsToMany(Tag::class);
    }
    function images(){
        return $this->hasMany(ProductImage::class);
    }
    function props(){
        return $this->hasMany(ProductProp::class);
    }
    function features(){
        return $this->belongsToMany(Feature::class);
    }
    function quentity(){
        return $this->hasMany(QuentityProduct::class);
    }
    function sizes(){
        return $this->belongsToMany(Size::class , 'product_sizes' , 'product_id' , 'size_id');
    }


    public function getTitleAttribute()
    {
        return session()->has('locale') && session()->get('locale') == 'ar' ? $this->title_ar : $this->title_en;
    }

    public function getDescriptionAttribute()
    {
        return session()->has('locale') && session()->get('locale') == 'ar' ? $this->description_ar : $this->description_en;
    }
}
