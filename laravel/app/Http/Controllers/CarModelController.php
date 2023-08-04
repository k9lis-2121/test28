<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CarModel;
use Illuminate\Http\Request;

class CarModelController extends Controller
{
    public function index()
    {
        $carModels = CarModel::all();

        return response()->json($carModels);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'brand_id' => 'required',
        ]);

        $carModel = CarModel::create($request->all());

        return response()->json($carModel, 201);
    }

    public function show(CarModel $carModel)
    {
        return response()->json($carModel);
    }
    
    public function update(Request $request, CarModel $carModel)
    {
        $request->validate([
            'name' => 'required',
            'brand_id' => 'required',
        ]);

        $carModel->update($request->all());

        return response()->json($carModel);
    }

    public function destroy(CarModel $carModel)
    {
        $carModel->delete();

        return response()->json(null, 204);
    }
}