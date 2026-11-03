<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PelangganApiController;
use App\Http\Controllers\Api\StaffApotekApiController;
use App\Http\Controllers\Api\ObatApiController;

Route::apiResource('pelanggans', PelangganApiController::class);
Route::apiResource('staff-apoteks', StaffApotekApiController::class);
Route::apiResource('obats', ObatApiController::class);