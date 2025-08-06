<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Devices\DeviceController;

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';


Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('devices', function () {
    return Inertia::render('devices/Index');
})->middleware(['auth', 'verified'])->name('devices.index');


Route::get('/api/devices', [DeviceController::class, 'getDevices']);

Route::get('/devices/create', function () {
    return Inertia::render('devices/CreateDevice');
})->middleware(['auth', 'verified'])->name('devices.create');

Route::post('/api/devices', [DeviceController::class, 'createDevice']);

