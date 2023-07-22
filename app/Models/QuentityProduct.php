<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuentityProduct extends Model
{
    use HasFactory;
    protected $fillable = ['product_id', 'quentity', 'size_id'];

    function product()
    {
        return $this->belongsTo(Product::class);
    }
    function size()
    {
        return $this->belongsTo(Size::class);
    }
}

