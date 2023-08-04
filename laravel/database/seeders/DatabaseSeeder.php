<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CarBrand;
use App\Models\CarModel;
use App\Models\Car;
use \App\Models\User;

class DatabaseSeeder extends Seeder
{


    /**
     * Для заполнения CarBrand и CarModel не используется фабрика, т.к. здесь проще всего создать 
     * связанные данные реальных брендов и моделей
     */


    private array $cars;

    public function __construct()
    {

        $this->cars = [
            'Toyota' => ['Tundra', 'Supra', 'Raf'], 
            'Honda' => ['Civic', 'Accord', 'Redgline'], 
            'Ford' => ['Mustang', 'Siera', 'Focus'], 
            'Chevrolet' => ['Corvet', 'Captiva', 'Groove'], 
            'Uaz' => ['Patriot', 'Hunter', 'Profi'], 
            'Lada' => ['Vesta', 'Calina', 'Granta'],
            'Gaz' => ['21', '3110', 'Siber'], 
            'Haval' => ['Jolion', 'F7', 'H9'], 
            'Volvo' => ['Cross Country', 'EX90', 'S40']];
    }

    public function processCars()
    {
        foreach ($this->cars as $brand => $models) {
            $brandObj = CarBrand::firstOrCreate(['name' => $brand]);

            foreach ($models as $index => $model) {
                $brandId = array_search($brand, array_keys($this->cars)) + 1;
                CarModel::firstOrCreate(['name' => $model, 'brand_id' => $brandId]);
            }
        }
    }

    public function run(): void
    {
        

        User::factory(10)->create();   
        $this->processCars();        
        Car::factory(10)->create(); 


    }
}
