<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;

Route::prefix('conferences')->name('conference.')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Employee Management page
    Route::get('/employees', [EmployeeController::class, 'index'])
        ->name('employees.index');

    // AJAX Employee Routes
    Route::get('/employees/data', [EmployeeController::class, 'getData'])
        ->name('employees.data');

    Route::post('/employees', [EmployeeController::class, 'store'])
        ->name('employees.store');

    Route::get('/employees/{id}', [EmployeeController::class, 'show'])
        ->name('employees.show');

    Route::put('/employees/{id}', [EmployeeController::class, 'update'])
        ->name('employees.update');

    Route::delete('/employees/{id}', [EmployeeController::class, 'destroy'])
        ->name('employees.destroy');
});
