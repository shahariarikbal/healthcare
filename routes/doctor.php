<?php

use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PrescriptionController;
use Illuminate\Support\Facades\Route;


Route::get('/doctor/login', [DoctorController::class, 'showLoginForm'])->name('doctor.login.form');
Route::post('/doctor/login', [DoctorController::class, 'login'])->name('doctor.login');
Route::middleware('auth:doctor')->group(function(){
       Route::get('/doctor/dashboard', [DoctorController::class, 'index'])->name('doctor.dashboard');
       Route::get('/doctor/profile/setting', [DoctorController::class, 'profileSetting'])->name('doctor.profile.settings');
       Route::post('/doctor/profile/setting/update', [DoctorController::class, 'profileSettingUpdate'])->name('doctor.profile.settings.update');
       Route::post('/doctor/logout', [DoctorController::class, 'doctorLogout'])->name('doctor.logout');

       //prescriptions route
    Route::group(['prefix' => 'prescription'], function(){
       Route::get('/add', [PrescriptionController::class, 'addPrescription'])->name('prescription.add');
       Route::post('/store', [PrescriptionController::class, 'prescriptionStore'])->name('prescription.store');
       Route::get('/all', [PrescriptionController::class, 'authUserPrescriptions'])->name('auth.doctor.prescription.list');
       Route::get('/{instruction}/view', [PrescriptionController::class, 'viewPrescriptions'])->name('prescription.view');
       Route::get('/{instruction}/pdf-download', [PrescriptionController::class, 'downloadPrescriptions'])->name('prescription.download.pdf');
       Route::get('/{instruction}/delete', [PrescriptionController::class, 'deletePrescriptions'])->name('prescription.delete');
       Route::get('/today-list', [PrescriptionController::class, 'showTodayPrescriptions'])->name('prescription.today');

       Route::get('/list', [PrescriptionController::class, 'allPrescriptions'])->name('prescription.all');
       Route::get('/daily-list', [PrescriptionController::class, 'dailyPrescriptions'])->name('prescription.daily');
   });
});
