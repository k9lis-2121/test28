<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Car extends Model
{
    use SoftDeletes, HasFactory;

   
    protected $table = 'cars';
    
    protected $fillable = [
        'brand_id',
        'model_id',
        'year',
        'mileage',
        'color',
        'user_id',
    ];

    public function brand()
    {
        return $this->belongsTo(CarBrand::class, 'brand_id');
    }

    public function model()
    {
        return $this->belongsTo(CarModel::class, 'model_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}