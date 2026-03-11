<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\categoryController;
use App\Http\Controllers\StatisticsController;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Request;

Route::middleware('auth:sanctum')->group(function(){
    Route::get('/profile', function (Request $request) {
        return $request->user();
    });

});

Route::post('/register',[AuthController::class , 'register']);
Route::post('/login',[AuthController::class, 'login'])->name('login');
Route::get('/categories/{id}/books', [BookController::class , 'booksByCategory']);
Route::get('/books/search', [BookController::class , 'search']);
Route::get('/books/popular', [BookController::class, 'popular']);
Route::get('/books/new', [BookController::class, 'newBooks']);

Route::middleware('auth:sanctum')->group(function() {
    Route::post('/categories',[categoryController::class , 'store']);
    Route::put('/categories/{id}',[categoryController::class , 'update']);
    Route::delete('/categories/{id}', [CategoryController::class, 'destroy']);

    Route::post('/books', [BookController::class, 'store']);
    Route::put('/books/{id}', [BookController::class, 'update']);
    Route::delete('/books/{id}', [BookController::class, 'destroy']);

    Route::get('/stats/most-viewed', [StatisticsController::class, 'mostViewed']);
});

