<?php

namespace Tests\Feature;

use App\Models\Car;
use App\Models\CarBrand;
use App\Models\CarModel;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CarControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testIndex()
    {
        $user = User::factory()->create();

        $carModels = CarModel::factory()->count(5)->create();
        $carBrands = CarBrand::factory()->count(5)->create();

        $cars = Car::factory()->count(3)->create([
            'user_id' => $user->id,
            'brand_id' => $carBrands->random()->id,
            'model_id' => $carModels->random()->id,
        ]);

        $response = $this->get('/api/cars/' . $user->id);

        $response->assertStatus(200);
    }


    public function testStore()
    {
        $user = User::factory()->create();
        $carBrand = CarBrand::factory()->create();
        $carModel = CarModel::factory()->create();
        

        $carData = [
            'brand_id' => $carBrand->id,
            'model_id' => $carModel->id,
            'year' => 2020,
            'mileage' => 50000,
            'color' => 'red',
            'user_id' => $user->id,
        ];

        $response = $this->post('/api/cars', $carData);

        $response->assertStatus(201)
            ->assertJson($carData);

        $this->assertDatabaseHas('cars', $carData);
    }

    public function testShow()
    {
        $user = User::factory()->create();
        $carModel = CarModel::factory()->create();
        $carBrand = CarBrand::factory()->create();
        
        $car = Car::factory()->create([
            'user_id' => $user->id,
            'brand_id' => $carBrand->id,
            'model_id' => $carModel->id,
        ]);

        $response = $this->get('/api/cars/' . $car->id);

        $response->assertStatus(200)
            ->assertJson($car->toArray());
    }


    public function testUpdate()
    {
        $user = User::factory()->create();
        $carBrand = CarBrand::factory()->create();
        $carModel = CarModel::factory()->create();

        $car = Car::factory()->create();

        $updatedData = [
            'brand_id' => $carBrand->id,
            'model_id' => $carModel->id,
            'year' => 2010,
            'mileage' => 100000,
            'color' => 'blue',
            'user_id' => $user->id,
        ];

        $response = $this->put('/api/cars/' . $car->id, $updatedData);

        $response->assertStatus(200)
            ->assertJson($updatedData);

        $this->assertDatabaseHas('cars', $updatedData);
    }

 
    public function testDestroy()
    {
        $user = User::factory()->create();
        $carModel = CarModel::factory()->create();
        $carBrand = CarBrand::factory()->create();
        
        $car = Car::factory()->create([
            'user_id' => $user->id,
            'brand_id' => $carBrand->id,
            'model_id' => $carModel->id,
        ]);

        $response = $this->delete('/api/cars/' . $car->id);

        $response->assertStatus(204);

    }
}