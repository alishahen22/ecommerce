<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function OrderItem(){
        return $this->hasMany(OrderItem::class);
    }
    public function getDateAttribute()
    {
        return date('d-m-Y', strtotime($this->created_at));
    }

    public function getTimeAttribute()
    {
        return date('h:i A', strtotime($this->created_at));
    }
}
