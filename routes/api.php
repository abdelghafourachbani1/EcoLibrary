<?php 


use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/profile', function (Request $request) {
    return $request->user();
});
