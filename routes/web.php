<?php

use App\Http\Controllers\DropdownController;

Route::get('/', [DropdownController::class, 'index']);
Route::post('/fetchstate', [DropdownController::class, 'fetchState']);
Route::post('/fetchcity', [DropdownController::class, 'fetchCity']);
