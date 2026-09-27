<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Damage extends Model
{
    protected $fillable = [
        'severity',
        'name',
        'price_min',
        'price_max',
        'estimated_days'
    ];
}