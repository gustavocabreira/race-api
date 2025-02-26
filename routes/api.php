<?php

use App\Http\Controllers\Api\DriverController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\LapController;
use App\Http\Controllers\RaceController;
use Illuminate\Support\Facades\Route;

Route::name('api.')->group(function () {
    Route::prefix('auth')->name('auth.')->group(function () {
        Route::post('login', [LoginController::class, 'login'])->name('login');
    });
    Route::apiResource('drivers', DriverController::class)->only('store');
    Route::apiResource('races', RaceController::class)->only('store', 'index');
    Route::apiResource('races.drivers.laps', LapController::class)->only('store');
    Route::get('/races/{race}/drivers', [RaceController::class, 'drivers'])->name('races.drivers.index');
});
