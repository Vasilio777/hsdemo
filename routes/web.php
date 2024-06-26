<?php

use App\Http\Controllers\EarthController;
use App\Http\Controllers\ExoplanetController;
use App\Http\Controllers\ExperimentController;
use App\Http\Controllers\PredictorController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('earth_states', EarthController::class);
Route::resource('exoplanets', ExoplanetController::class);
Route::resource('predictors', PredictorController::class);
Route::resource('experiments', ExperimentController::class);