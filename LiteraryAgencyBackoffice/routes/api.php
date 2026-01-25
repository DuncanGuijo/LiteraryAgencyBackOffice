<?php

use App\Http\Controllers\AgencyController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\GenreController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

// Without Token
Route::prefix('v1')->group(function () {
    Route::post('/register', [UserController::class, 'register']);
    Route::post('/login', [UserController::class,'login']);
});

// With Token
Route::prefix('v1')->middleware(['auth:api'])->group(function () {

    // Users
    Route::get('/user/{id}', [UserController::class, 'get'])->whereNumber('id');
    Route::put('/user/{id}', [UserController::class, 'update'])->whereNumber('id');
    Route::post('/logout', [UserController::class, 'logout']);

    // Books
    Route::get('/books', [BookController::class, 'index']);
    Route::get('/books/{id}', [BookController::class, 'show'])->whereNumber('id');
    Route::post('/books', [BookController::class, 'create']);
    Route::put('/books/{id}', [BookController::class, 'update'])->whereNumber('id');
    Route::delete('/books/{id}', [BookController::class, 'destroy'])->whereNumber('id');

    // Agencies
    Route::get('/agencies', [AgencyController::class, 'index']);
    Route::get('/agencies/{id}', [AgencyController::class, 'show'])->whereNumber('id');
    Route::post('/agencies', [AgencyController::class, 'create']);
    Route::put('/agencies/{id}', [AgencyController::class, 'update'])->whereNumber('id');
    Route::delete('/agencies/{id}', [AgencyController::class, 'destroy'])->whereNumber('id');

    // Authors
    Route::get('/authors', [AuthorController::class, 'index']);
    Route::get('/authors/{id}', [AuthorController::class, 'show'])->whereNumber('id');
    Route::post('/authors', [AuthorController::class, 'create']);
    Route::put('/authors/{id}', [AuthorController::class, 'update'])->whereNumber('id');
    Route::delete('/authors/{id}', [AuthorController::class, 'destroy'])->whereNumber('id');

    // Genres
    Route::get('/genres', [GenreController::class, 'index']);
    Route::post('/genres', [GenreController::class, 'create']);
    Route::put('/genres/{id}', [GenreController::class, 'update'])->whereNumber('id');
    Route::delete('/genres/{id}', [GenreController::class, 'destroy'])->whereNumber('id');
});
