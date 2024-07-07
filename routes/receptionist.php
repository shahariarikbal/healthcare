<?php

use App\Http\Controllers\ReceptionistController;
use Illuminate\Support\Facades\Route;


Route::get('/receptionist/login', [ReceptionistController::class, 'showLoginForm'])->name('receptionist.login.form');
Route::post('/receptionist/login', [ReceptionistController::class, 'login'])->name('receptionist.login');
Route::middleware('auth:receptionist')->group(function(){
      Route::get('/receptionist/dashboard', [ReceptionistController::class, 'index'])->name('receptionist.dashboard');
      Route::post('/receptionist/logout', [ReceptionistController::class, 'logout'])->name('receptionist.logout');
});
