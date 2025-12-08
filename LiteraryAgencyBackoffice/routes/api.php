<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

// Without Token
Route::prefix('v1')->group(function () {
    Route::post('/register', [UserController::class, 'register']);
    Route::post('/login', [UserController::class,'login']);
});

// With Token
Route::prefix('v1')->middleware(['auth:api'])->group(function () {
    Route::get('/user/{id}', [UserController::class, 'get']);
    Route::get('/logout', [UserController::class,'logout']);
});
