<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CarBrand;
use Illuminate\Http\Request;

class CarBrandController extends Controller
{

    public function index()
    {
        $carBrands = CarBrand::all();
        return response()->json($carBrands);
    }

    public function store(Request $request)
    {
        $carBrand = CarBrand::create($request->all());
        return response()->json($carBrand, 201);
    }

    public function show($id)
    {
        $carBrand = CarBrand::findOrFail($id);
        return response()->json($carBrand);
    }

    public function update(Request $request, $id)
    {
        $carBrand = CarBrand::findOrFail($id);
        $carBrand->update($request->all());

        return response()->json($carBrand);
    }

    public function destroy($id)
    {
        $carBrand = CarBrand::findOrFail($id);
        $carBrand->delete();

        return response()->json(null, 204);
    }
}