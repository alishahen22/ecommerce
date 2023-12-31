<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $fillable = ['path','product_id'];
    use HasFactory;
    function product(){
        return $this->belongsTo(Product::class);
    }
}
