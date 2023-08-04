<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CarBrand extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'car_brand';

    protected $fillable = [
        'name',
    ];

    public function carModels()
    {
        return $this->hasMany(CarModel::class, 'brand_id');
    }

    public function cars()
    {
        return $this->hasManyThrough(Car::class, CarModel::class, 'brand_id', 'model_id');
    }
}