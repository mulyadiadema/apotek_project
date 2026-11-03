<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\StaffApotekController;
use App\Http\Controllers\ObatController;

// Halaman utama
Route::get('/', [DashboardController::class, 'index'])
    ->name('home');

// Router Pelanggan
Route::post('/pelanggan', [PelangganController::class, 'store'])
    ->name('pelanggan.store');

Route::get('/pelanggan/{id}/edit', [PelangganController::class, 'edit'])
    ->name('pelanggan.edit');

Route::put('/pelanggan/{id}', [PelangganController::class, 'update'])
    ->name('pelanggan.update');

Route::delete('/pelanggan/{id}', [PelangganController::class, 'destroy'])
    ->name('pelanggan.destroy');

// Router Staf Apotek
Route::post('/staff', [StaffApotekController::class, 'store'])
    ->name('staff.store');

Route::get('/staff/{id}/edit', [StaffApotekController::class, 'edit'])
    ->name('staff.edit');

Route::put('/staff/{id}', [StaffApotekController::class, 'update'])
    ->name('staff.update');

Route::delete('/staff/{id}', [StaffApotekController::class, 'destroy'])
    ->name('staff.destroy');

// Router Obat
Route::post('/obat', [ObatController::class, 'store'])
    ->name('obat.store');

Route::get('/obat/{id}/edit', [ObatController::class, 'edit'])
    ->name('obat.edit');

Route::put('/obat/{id}', [ObatController::class, 'update'])
    ->name('obat.update');

Route::delete('/obat/{id}', [ObatController::class, 'destroy'])
    ->name('obat.destroy');
