<?php

use App\Http\Controllers\AgencyController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\GenreController;
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
    // Users
    Route::get('/user/{id}', [UserController::class, 'get']);
    Route::get('/logout', [UserController::class,'logout']);
    // Books
    Route::post('createBook',  [BookController::class,'create']);
    Route::post('updateBook',  [BookController::class,'update']);
    Route::post('destroyBook',  [BookController::class,'destroy']);
    //Agencies
    Route::post('createAgency',  [AgencyController::class,'create']);
    Route::post('updateAgency',  [AgencyController::class,'update']);
    Route::post('destroyBook',  [BookController::class,'destroy']);
    //Authors
    Route::post('createAuthor',  [AuthorController::class,'create']);
    Route::post('updateAuthor',  [AuthorController::class,'update']);
    Route::post('destroyBook',  [BookController::class,'destroy']);
    //Genres
    Route::post('createAuthor',  [GenreController::class,'create']);
    Route::post('updateAuthor',  [GenreController::class,'update']);
    Route::post('destroyBook',  [GenreController::class,'destroy']);
});
