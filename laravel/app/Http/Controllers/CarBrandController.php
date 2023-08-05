<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CarBrand;
use Illuminate\Http\Request;


/**
 * @OA\Tag(
 *     name="Бренды",
 *     description="Методы для работы с брендами автомабилей"
 * )
 */
class CarBrandController extends Controller
{

    /**
     * @OA\Get(
     *     path="/api/carBrands",
     *     summary="Получить список брендов",
     *     @OA\Response(response="200", description="Список брендов"),
     *     tags={"Бренды"}
     * )
     */
    public function index()
    {
        $carBrands = CarBrand::all();
        return response()->json($carBrands);
    }

    /**
     * @OA\Post(
     *     path="/api/carBrands",
     *     summary="Добавить новый бренд",
     *     @OA\Response(response="201", description="Готово! Новый бренд создан"),
     *     @OA\RequestBody(
     *         @OA\JsonContent(ref="#/components/schemas/CarBrand")
     *     ),
     *      tags={"Бренды"}
     * )
     */
    public function store(Request $request)
    {
        $carBrand = CarBrand::create($request->all());
        return response()->json($carBrand, 201);
    }

    /**
     * @OA\Get(
     *     path="/api/carBrands/{id}",
     *     summary="Получить информацию о конкретном бренде",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID бренда",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(response="200", description="Бренд"),
     *      tags={"Бренды"}
     * 
     * )
     */
    public function show($id)
    {
        $carBrand = CarBrand::findOrFail($id);
        return response()->json($carBrand);
    }

    /**
     * @OA\Put(
     *     path="/api/carBrands/{id}",
     *     summary="Обновить запись о бренде",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID бренда",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(response="200", description="Запись обновлена!"),
     *     @OA\RequestBody(
     *         @OA\JsonContent(ref="#/components/schemas/CarBrand")
     *     ),
     *      tags={"Бренды"}
     * )
     */
    public function update(Request $request, $id)
    {
        $carBrand = CarBrand::findOrFail($id);
        $carBrand->update($request->all());

        return response()->json($carBrand);
    }

    /**
     * @OA\Delete(
     *     path="/api/carBrands/{id}",
     *     summary="Удалить бренд",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID бренда",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(response="204", description="Готово! Бренд удален"),
     *      tags={"Бренды"}
     * )
     */
    public function destroy($id)
    {
        $carBrand = CarBrand::findOrFail($id);
        $carBrand->delete();

        return response()->json(null, 204);
    }
}