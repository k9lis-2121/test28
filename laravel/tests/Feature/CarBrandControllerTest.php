<?php

namespace Tests\Feature;

use App\Models\CarBrand;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class CarBrandControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function testIndex()
    {
        $response = $this->get('/api/carBrands');

        $response->assertStatus(200)
            ->assertJson(CarBrand::all()->toArray());
    }

    public function testStore()
    {
        $carBrandData = [
            'name' => 'Test Brand',
        ];

        $response = $this->post('/api/carBrands', $carBrandData);

        $response->assertStatus(201)
            ->assertJson($carBrandData);
        
        $this->assertDatabaseHas('car_brand', $carBrandData);
    }

    public function testShow()
    {
    $carBrand = CarBrand::factory()->create();

    $response = $this->get('/api/carBrands/' . $carBrand->id);

    $response->assertStatus(200)
        ->assertJson($carBrand->toArray());
    }


    public function testUpdate()
    {
        $carBrand = CarBrand::factory()->create();

        $updatedData = [
            'name' => 'Updated Brand',
        ];

        $response = $this->put('/api/carBrands/' . $carBrand->id, $updatedData);

        $response->assertStatus(200)
            ->assertJson($updatedData);

        $this->assertDatabaseHas('car_brand', $updatedData);
    }

    public function testDestroy()
    {
        $carBrand = CarBrand::factory()->create();

        $response = $this->delete('/api/carBrands/' . $carBrand->id);

        $response->assertStatus(204);
    }
}