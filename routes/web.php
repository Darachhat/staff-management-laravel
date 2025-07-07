<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\WorkDayController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\HolidayController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Employee Management
    Route::resource('employees', EmployeeController::class);
    Route::get('employees/{employee}/documents', [EmployeeController::class, 'documents'])->name('employees.documents');
    Route::post('employees/{employee}/documents', [EmployeeController::class, 'uploadDocument'])->name('employees.documents.upload');

    // Attendance Management
    Route::get('attendances', [AttendanceController::class, 'index'])->name('attendances.index');
    Route::get('attendances/clock', [AttendanceController::class, 'clockPage'])->name('attendances.clock');
    Route::post('attendance/clock-in', [AttendanceController::class, 'clockIn'])->name('attendance.clock-in');
    Route::post('attendance/clock-out', [AttendanceController::class, 'clockOut'])->name('attendance.clock-out');
    Route::get('attendances/reports', [AttendanceController::class, 'reports'])->name('attendances.reports');
    Route::get('attendances/daily-report', [AttendanceController::class, 'dailyReport'])->name('attendances.daily-report');

    // Leave Management
    Route::resource('leaves', LeaveController::class);
    Route::post('leaves/{leave}/approve', [LeaveController::class, 'approve'])->name('leaves.approve');
    Route::post('leaves/{leave}/reject', [LeaveController::class, 'reject'])->name('leaves.reject');
    Route::get('leave-types', [LeaveController::class, 'leaveTypes'])->name('leave-types.index');
    Route::resource('leave-types', LeaveController::class, ['as' => 'leave-types']);

    // Settings Management
    Route::get('settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::post('settings', [SettingsController::class, 'update'])->name('settings.update');
    Route::resource('holidays', HolidayController::class);
    Route::resource('work-days', WorkDayController::class);
    Route::resource('cards', CardController::class);
});

require __DIR__.'/auth.php';
