<?php

namespace Database\Factories;

use App\Models\Car;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CarFactory extends Factory
{

    public function definition(): array
    {


        $brandIds = DB::table('car_brand')->pluck('id')->toArray();
        $modelIds = DB::table('car_model')->pluck('id')->toArray();
        $userIds = DB::table('users')->pluck('id')->toArray();

            return [
                'brand_id' => fake()->randomElement($brandIds),
                'model_id' => fake()->randomElement($modelIds),
                'year' => fake()->year(),
                'mileage' => fake()->numberBetween(1000, 50000),
                'color' => fake()->colorName(),
                'user_id' => fake()->randomElement($userIds),
            ];
    }

};