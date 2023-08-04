<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;
use App\Models\CarBrand;
use App\Models\CarModel;

class CarController extends Controller
{
    public function index($user_id)
    {
        $cars = Car::where('user_id', $user_id)
                    ->join('car_brand', 'cars.brand_id', '=', 'car_brand.id')
                    ->join('car_model', 'cars.model_id', '=', 'car_model.id')
                    ->select('cars.id', 'car_brand.name as brand_name', 'car_model.name as model_name', 'year', 'mileage', 'color')
                    ->get();

        return response()->json($cars);
    }

    public function store(Request $request)
    {
        $request->validate([
            'brand_id' => 'required',
            'model_id' => 'required',
            'year' => 'nullable|integer',
            'mileage' => 'nullable|integer',
            'color' => 'nullable|string',
            'user_id' => 'nullable|exists:users,id',
        ]);

        $car = Car::create($request->all());

        return response()->json($car, 201);
    }

    public function show(Car $car)
    {
        return response()->json($car);
    }

    public function update(Request $request, Car $car)
    {
        $request->validate([
            'brand_id' => 'required',
            'model_id' => 'required',
            'year' => 'nullable|integer',
            'mileage' => 'nullable|integer',
            'color' => 'nullable|string',
            'user_id' => 'nullable|exists:users,id',
        ]);
        
        $car->update($request->all());

        return response()->json($car);
    }

    public function destroy(Car $car)
    {
        $car->delete();

        return response()->json(null, 204);
    }
}