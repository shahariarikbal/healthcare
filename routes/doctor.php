<?php

use App\Http\Controllers\DoctorController;
use Illuminate\Support\Facades\Route;


Route::get('/doctor/login', [DoctorController::class, 'showLoginForm'])->name('doctor.login.form');
Route::post('/doctor/login', [DoctorController::class, 'login'])->name('doctor.login');
Route::middleware('auth:doctor')->group(function(){
       Route::get('/doctor/dashboard', [DoctorController::class, 'index'])->name('doctor.dashboard');
       Route::post('/doctor/logout', [DoctorController::class, 'doctorLogout'])->name('doctor.logout');
});
