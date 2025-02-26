<?php

use App\Http\Controllers\Api\DriverController;
use App\Http\Controllers\LapController;
use App\Http\Controllers\RaceController;
use Illuminate\Support\Facades\Route;

Route::name('api.')->group(function () {
    Route::apiResource('drivers', DriverController::class)->only('store');
    Route::apiResource('races', RaceController::class)->only('store');
    Route::apiResource('races.drivers.laps', LapController::class)->only('store');
});
