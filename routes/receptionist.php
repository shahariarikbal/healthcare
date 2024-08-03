<?php

use App\Http\Controllers\ReceptionistController;
use Illuminate\Support\Facades\Route;


Route::get('/receptionist/login', [ReceptionistController::class, 'showLoginForm'])->name('receptionist.login.form');
Route::post('/receptionist/login', [ReceptionistController::class, 'login'])->name('receptionist.login');
Route::middleware('auth:receptionist')->group(function(){
      Route::get('/receptionist/dashboard', [ReceptionistController::class, 'index'])->name('receptionist.dashboard');
      Route::get('/receptionist/profile/setting', [ReceptionistController::class, 'profileSetting'])->name('receptionist.profile.settings');
      Route::post('/receptionist/profile/setting/update', [ReceptionistController::class, 'profileSettingUpdate'])->name('receptionist.profile.settings.update');
      Route::post('/receptionist/profile/password/update', [ReceptionistController::class, 'profilePasswordUpdate'])->name('receptionist.profile.password.update');
      Route::post('/receptionist/logout', [ReceptionistController::class, 'logout'])->name('receptionist.logout');
});
