<?php

use App\Http\Controllers\DoctorController;
use Illuminate\Support\Facades\Route;


Route::get('/doctor/login', [DoctorController::class, 'showLoginForm'])->name('doctor.login.form');
Route::post('/doctor/login', [DoctorController::class, 'login'])->name('doctor.login');
Route::get('/doctor/dashboard', [DoctorController::class, 'index'])->name('doctor.dashboard');
