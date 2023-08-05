<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;


/**
 * @OA\Schema(
 *     schema="Car",
 *     title="Car",
 *     description="Модель автомобиля",

 *     @OA\Property(
 *         property="brand_id",
 *         type="integer",
 *         description="Идентификатор бренда автомобиля"
 *     ),
 *     @OA\Property(
 *         property="model_id",
 *         type="integer",
 *         description="Идентификатор модели автомобиля"
 *     ),
 *     @OA\Property(
 *         property="year",
 *         type="integer",
 *         description="Год выпуска автомобиля"
 *     ),
 *     @OA\Property(
 *         property="mileage",
 *         type="integer",
 *         description="Пробег автомобиля в километрах"
 *     ),
 *     @OA\Property(
 *         property="color",
 *         type="string",
 *         description="Цвет автомобиля"
 *     ),
 *     @OA\Property(
 *         property="user_id",
 *         type="integer",
 *         description="Идентификатор пользователя, владеющего автомобилем"
 *     ),
 *     @OA\Property(
 *         property="created_at",
 *         type="string",
 *         format="date-time",
 *         description="Дата и время создания автомобиля"
 *     ),
 *     @OA\Property(
 *         property="updated_at",
 *         type="string",
 *         format="date-time",
 *         description="Дата и время последнего обновления автомобиля"
 *     ),
 *     @OA\Property(
 *         property="deleted_at",
 *         type="string",
 *         format="date-time",
 *         nullable=true,
 *         description="Дата и время удаления автомобиля (если применимо)"
 *     )
 * )
 */


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