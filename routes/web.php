<?php

use App\Http\Controllers\EarthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('earth_states', EarthController::class);
