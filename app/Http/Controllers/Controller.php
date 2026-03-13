<?php

namespace App\Http\Controllers;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *     title="EcoLibrary API",
 *     version="1.0.0",
 *     description="API documentation for the EcoLibrary project"
 * )
 */

abstract class Controller
{
    use AuthorizesRequests, ValidatesRequests;
}
