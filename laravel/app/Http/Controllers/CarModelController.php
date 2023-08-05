<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CarModel;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Модели",
 *     description="Методы для работы с моделями автомобилей"
 * )
 */
class CarModelController extends Controller
{

    /**
     * @OA\Get(
     *     path="/api/carModels",
     *     summary="Получить список моделей автомобилей",
     *     @OA\Response(response="200", description="Список моделей автомобилей"),
     *     tags={"Модели"}
     * )
     */
    public function index()
    {
        $carModels = CarModel::all();

        return response()->json($carModels);
    }

    /**
     * @OA\Post(
     *     path="/api/carModels",
     *     summary="Создать новую модель автомобиля",
     *     @OA\Response(response="201", description="Модель автомобиля успешно создана"),
     *     @OA\RequestBody(
     *         @OA\JsonContent(
     *             @OA\Property(property="name", type="string", description="Название модели автомобиля"),
     *             @OA\Property(property="brand_id", type="integer", description="Идентификатор бренда модели автомобиля")
     *         )
     *     ),
     *     tags={"Модели"}
     * )
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'brand_id' => 'required',
        ]);

        $carModel = CarModel::create($request->all());

        return response()->json($carModel, 201);
    }

    /**
     * @OA\Get(
     *     path="/api/carModels/{id}",
     *     summary="Получить информацию о модели автомобиля",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID модели",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(response="200", description="Информация о модели автомобиля"),
     *     tags={"Модели"}
     * )
     */
    public function show(CarModel $carModel)
    {
        return response()->json($carModel);
    }
    
    /**
     * @OA\Put(
     *     path="/api/carModels/{id}",
     *     summary="Обновить информацию о модели автомобиля",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID модели",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(response="200", description="Информация о модели автомобиля успешно обновлена"),
     *     @OA\RequestBody(
     *         @OA\JsonContent(
     *             @OA\Property(property="name", type="string", description="Название модели автомобиля"),
     *             @OA\Property(property="brand_id", type="integer", description="Идентификатор бренда модели автомобиля")
     *         )
     *     ),
     *     tags={"Модели"}
     * )
     */
    public function update(Request $request, CarModel $carModel)
    {
        $request->validate([
            'name' => 'required',
            'brand_id' => 'required',
        ]);

        $carModel->update($request->all());

        return response()->json($carModel);
    }

    /**
     * @OA\Delete(
     *     path="/api/carModels/{id}",
     *     summary="Удалить модель автомобиля",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID модели",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(response="204", description="Модель автомобиля успешно удалена"),
     *     tags={"Модели"}
     * )
     */
    public function destroy(CarModel $carModel)
    {
        $carModel->delete();

        return response()->json(null, 204);
    }
}