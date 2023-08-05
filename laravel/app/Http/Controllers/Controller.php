<?php

namespace App\Http\Controllers;
/**
 * @OA\Info(
 *     title="test28 API",
 *     version="1.0",
 *     description="API по тестовому заданию"
 * ),
 * @OA\Get(
 *     path="/api/users/",
 *     summary="List users",
 *     operationId="list_users",
 *     description="Returns a list of users that are registered on a server with pagination",
 *     @OA\Response(
 *         response=200,
 *         description="List of users",
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Something went wrong",
 *     )
 * )
*/
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    
    use AuthorizesRequests, ValidatesRequests;
}
