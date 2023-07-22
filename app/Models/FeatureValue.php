<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeatureValue extends Model
{
    protected $Table = ['feature_values'];
    use HasFactory;
    protected $fillable = [
        'value_en',
        'value_ar',
        'feature_id',
    ];
    public function feature()
    {
        return $this->belongsTo(Feature::class);
    }
}
