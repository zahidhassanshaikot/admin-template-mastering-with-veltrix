<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PatientController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\RoleController;

Route::redirect('/', 'login');

Route::middleware(['auth', 'verified'])->group(function (){
    Route::get('/dashboard',[DashboardController::class,'index'] )->name('dashboard');

    Route::resource('users',UserController::class);
    Route::resource('settings', SettingController::class)->only(['index', 'store']);
    Route::resource('roles', RoleController::class);
});

require __DIR__.'/auth.php';
require __DIR__.'/command_routes.php';
