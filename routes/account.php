<?php

use App\Http\Controllers\AccountController;
use Illuminate\Support\Facades\Route;


Route::get('/account/login', [AccountController::class, 'showLoginForm'])->name('account.login.form');
Route::post('/account/login', [AccountController::class, 'login'])->name('account.login');
Route::get('/account/dashboard', [AccountController::class, 'account'])->name('account.dashboard');
