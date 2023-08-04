<?php

namespace Database\Factories;

use App\Models\CarModel;
use Illuminate\Database\Eloquent\Factories\Factory;

class CarModelFactory extends Factory
{
    protected $model = CarModel::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'brand_id' => rand(2, 50),
        ];
    }
}