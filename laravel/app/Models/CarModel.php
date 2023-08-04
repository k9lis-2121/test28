<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CarModel extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'car_model';

    protected $fillable = [
        'name',
        'brand_id',
    ];

    public function brand()
    {
        return $this->belongsTo(CarBrand::class, 'brand_id');
    }

    public function cars()
    {
        return $this->hasMany(Car::class, 'model_id');
    }
}