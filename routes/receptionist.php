<?php

use App\Http\Controllers\ReceiptionistController;
use Illuminate\Support\Facades\Route;


Route::get('/receptionist/login', [ReceiptionistController::class, 'showLoginForm'])->name('receptionist.login.form');
Route::post('/receptionist/login', [ReceiptionistController::class, 'login'])->name('receptionist.login');
Route::middleware('auth:receptionist')->group(function(){
      Route::get('/receptionist/dashboard', [ReceiptionistController::class, 'index'])->name('receptionist.dashboard');
      Route::post('/receptionist/logout', [ReceiptionistController::class, 'logout'])->name('receptionist.logout');
});
