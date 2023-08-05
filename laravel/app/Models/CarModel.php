<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @OA\Schema(
 *     schema="carModel",
 *     title="Car Model",
 *     description="Модель автомобиля",
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         description="Уникальный идентификатор модели автомобиля"
 *     ),
 *     @OA\Property(
 *         property="name",
 *         type="string",
 *         description="Название модели автомобиля"
 *     ),
 *     @OA\Property(
 *         property="brand_id",
 *         type="integer",
 *         description="Идентификатор бренда модели автомобиля"
 *     ),
 *     @OA\Property(
 *         property="created_at",
 *         type="string",
 *         format="date-time",
 *         description="Дата и время создания модели автомобиля"
 *     ),
 *     @OA\Property(
 *         property="updated_at",
 *         type="string",
 *         format="date-time",
 *         description="Дата и время последнего обновления модели автомобиля"
 *     ),
 *     @OA\Property(
 *         property="deleted_at",
 *         type="string",
 *         format="date-time",
 *         nullable=true,
 *         description="Дата и время удаления модели автомобиля (если применимо)"
 *     )
 * )
 */
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