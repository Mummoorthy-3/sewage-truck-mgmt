<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\LabourController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\LoadController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\AccountController;


// Guest routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'sendOtp'])->name('login.sendOtp');
    Route::post('/otp-verify', [LoginController::class, 'verifyOtp'])->name('login.verifyOtp');
});

// Authenticated routes
Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

    // Admin + Subadmin can access:
    Route::middleware('role:admin,subadmin')->group(function () {
        Route::resource('companies', CompanyController::class);
        Route::resource('labours', LabourController::class);
        Route::resource('vehicles', VehicleController::class);
        Route::resource('loads', LoadController::class);
        Route::get('attendance', [AttendanceController::class, 'index'])->name('attendance.index');
        Route::post('attendance', [AttendanceController::class, 'store'])->name('attendance.store');
        Route::get('salary', [SalaryController::class, 'index'])->name('salary.index');
        Route::post('salary/generate', [SalaryController::class, 'generate'])->name('salary.generate');
        Route::get('accounts', [AccountController::class, 'index'])->name('accounts.index');
        
    });

    // Example: Admin-only extra routes could go inside role:admin
});
