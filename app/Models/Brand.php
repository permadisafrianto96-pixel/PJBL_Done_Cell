<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\PhoneModel;

class Brand extends Model
{
    protected $fillable = [
        'name'
    ];

    public function phoneModels()
    {
        return $this->hasMany(PhoneModel::class);
    }
}