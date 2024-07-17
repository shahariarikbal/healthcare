<?php

use App\Http\Controllers\AccountController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'account', 'as' => 'account.'], function(){
      Route::get('/login', [AccountController::class, 'showLoginForm'])->name('login.form');
      Route::post('/login', [AccountController::class, 'login'])->name('login');
      Route::middleware('auth:account')->group(function(){
            Route::get('/dashboard', [AccountController::class, 'index'])->name('dashboard');
            Route::get('/profile/setting', [AccountController::class, 'profileSetting'])->name('profile.settings');
            Route::post('/profile/setting/update', [AccountController::class, 'profileSettingUpdate'])->name('profile.settings.update');
            Route::post('/logout', [AccountController::class, 'logout'])->name('logout');
      });
});


