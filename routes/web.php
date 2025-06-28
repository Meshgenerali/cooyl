<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataImport;
use App\Http\Controllers\RegisterController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::post('/import', [DataImport::class, 'import'])->name('import');
Route::get('/register/form', [RegisterController::class, 'showRegistrationForm']);
Route::get('/api/constituencies', [RegisterController::class, 'getConstituencies']);
Route::get('/api/wards', [RegisterController::class, 'getWards']);
Route::get('/api/polling-stations', [RegisterController::class, 'getPollingStations']);
