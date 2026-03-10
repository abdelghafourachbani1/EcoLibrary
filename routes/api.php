<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Request;

Route::middleware('auth:sanctum')->group(function(){
    Route::get('/profile', function (Request $request) {
        return $request->user();
    });

});

Route::post('/register',[AuthController::class , 'register']);
Route::post('/login',[AuthController::class, 'login']);
