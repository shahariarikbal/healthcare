<?php

use App\Http\Controllers\AccountController;
use Illuminate\Support\Facades\Route;


Route::get('/account/login', [AccountController::class, 'showLoginForm'])->name('account.login.form');
Route::post('/account/login', [AccountController::class, 'login'])->name('account.login');
Route::middleware('auth:account')->group(function(){
      Route::get('/account/dashboard', [AccountController::class, 'index'])->name('account.dashboard');
      Route::post('/account/logout', [AccountController::class, 'logout'])->name('account.logout');
});

