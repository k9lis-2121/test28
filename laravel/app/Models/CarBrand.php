<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @OA\Schema(
 *     schema="CarBrand",
 *     title="Car Brand",
 *     description="Модель данных для списка брендов автомобилей",
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         description="ID бренда"
 *     ),
 *     @OA\Property(
 *         property="name",
 *         type="string",
 *         description="Название бренда"
 *     ),
 *     @OA\Property(
 *         property="created_at",
 *         type="string",
 *         format="date-time",
 *         description="Дата создания записи"
 *     ),
 *     @OA\Property(
 *         property="updated_at",
 *         type="string",
 *         format="date-time",
 *         description="Дата и время обновления записи"
 *     )
 * )
 */
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