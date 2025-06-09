<?php

use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:api'])->group(function () {
    Route::apiResource('user', UserController::class);
    Route::middleware('admin')->group(function () {
        Route::apiResource('profile', ProfileController::class);
    });
});

Route::post('login', [AuthController::class, 'login']);