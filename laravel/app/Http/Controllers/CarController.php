<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Автомобили",
 *     description="Методы для работы с автомобилями"
 * )
 */
class CarController extends Controller
{


    /**
     * @OA\Get(
     *     path="/api/cars/",
     *     summary="Получить список всех автомобилей",
     *     @OA\Response(
     *         response="200",
     *         description="Список автомобилей пользователей"
     *     ),
     *     tags={"Автомобили"}
     * )
     */
    public function index($user_id = false)
    {
        $cars = Car::all();
        return response()->json($cars);
    }

    /**
     * @OA\Get(
     *     path="/api/cars/user_id/{user_id}",
     *     summary="Получить список автомобилей пользователя",
     *     @OA\Parameter(
     *         name="user_id",
     *         in="path",
     *         description="Идентификатор пользователя",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Список автомобилей пользователя"
     *     ),
     *     tags={"Автомобили"}
     * )
     */
    public function userCars($user_id){
        $cars = Car::where('user_id', $user_id)
        ->join('car_brand', 'cars.brand_id', '=', 'car_brand.id')
        ->join('car_model', 'cars.model_id', '=', 'car_model.id')
        ->select('cars.id', 'car_brand.name as brand_name', 'car_model.name as model_name', 'year', 'mileage', 'color')
        ->get();

        return response()->json($cars);
    }

    /**
     * @OA\Post(
     *     path="/api/cars",
     *     summary="Создать новый автомобиль",
     *     @OA\Response(
     *         response="201",
     *         description="Автомобиль успешно создан"
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             ref="#/components/schemas/Car"
     *         )
     *     ),
     *     tags={"Автомобили"}
     * )
     */
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

    /**
     * @OA\Get(
     *     path="/api/cars/{id}",
     *     summary="Получить информацию об автомобиле",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Идентификатор автомобиля",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Информация об автомобиле"
     *     ),
     *     tags={"Автомобили"}
     * )
     */
    public function show(Car $car)
    {
        return response()->json($car);
    }

     /**
     * @OA\Put(
     *     path="/api/cars/{id}",
     *     summary="Обновить информацию об автомобиле",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Идентификатор автомобиля",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Информация об автомобиле успешно обновлена"
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             ref="#/components/schemas/Car"
     *         )
     *     ),
     *     tags={"Автомобили"}
     * )
     */
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

     /**
     * @OA\Delete(
     *     path="/api/cars/{id}",
     *     summary="Удалить автомобиль",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Идентификатор автомобиля",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response="204",
     *         description="Автомобиль успешно удален"
     *     ),
     *     tags={"Автомобили"}
     * )
     */

    public function destroy(Car $car)
    {
        $car->delete();

        return response()->json(null, 204);
    }
}