<?php

namespace Tests\Feature;

use App\Models\CarModel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CarModelControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testIndex()
    {
        CarModel::factory()->count(5)->create();

        $response = $this->get('/api/carModels');

        $response->assertStatus(200)
            ->assertJsonCount(5);
    }


    public function testStore()
    {
        $carModelData = [
            'name' => 'Test Car Model',
            'brand_id' => 1,
        ];

        $response = $this->post('/api/carModels', $carModelData);

        $response->assertStatus(201)
            ->assertJson($carModelData);

        $this->assertDatabaseHas('car_model', $carModelData);
    }


    public function testShow()
    {
        $carModel = CarModel::factory()->create();

        $response = $this->get('/api/carModels/' . $carModel->id);

        $response->assertStatus(200)
            ->assertJson($carModel->toArray());
    }


    public function testUpdate()
    {
        $carModel = CarModel::factory()->create();

        $updatedData = [
            'name' => 'Updated Car Model',
            'brand_id' => 2,
        ];

        $response = $this->put('/api/carModels/' . $carModel->id, $updatedData);

        $response->assertStatus(200)
            ->assertJson($updatedData);

        $this->assertDatabaseHas('car_model', $updatedData);
    }


    public function testDestroy()
    {
        $carModel = CarModel::factory()->create();

        $response = $this->delete('/api/carModels/' . $carModel->id);

        $response->assertStatus(204);

    }
}