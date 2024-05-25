<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\NurseController;
use App\Http\Controllers\PatientController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Config cache clear
Route::get('clear', function () {
    \Artisan::call('optimize:clear');
    return redirect()->back()->with('success', 'Your old cache has been cleared now');
});

//if you need to add some additional field in producttion database table or migrate new table then run this command in your browser
Route::get('migrate', function (){
    \Artisan::call('migrate');
    dd('Migrated');
});

Route::get('/', [LoginController::class, 'showAdminLoginForm']);

  Auth::routes([
    'register' => false, // Registration Routes...
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
  ]);

  Route::get('/admin/dashboard', [HomeController::class, 'index'])->name('admin.dashboard');

    //Department controller routes
    Route::group(['prefix' => 'department'], function(){
        Route::get('/create', [DepartmentController::class, 'showDepartmentCreateForm'])->name('department.create');
        Route::get('/manage', [DepartmentController::class, 'manageDepartment'])->name('department.manage');
        Route::post('/store', [DepartmentController::class, 'store'])->name('department.store');
        Route::get('/edit/{id}', [DepartmentController::class, 'edit'])->name('department.edit');
        Route::post('/update/{id}', [DepartmentController::class, 'update'])->name('department.update');
        Route::get('/delete/{id}', [DepartmentController::class, 'delete'])->name('department.delete');
    });

    //Doctor routes
    Route::group(['prefix' => 'doctor'], function(){
        Route::get('/create', [DoctorController::class, 'showDoctorAddForm'])->name('doctor.create');
        Route::get('/manage', [DoctorController::class, 'doctorManage'])->name('doctor.manage');
        Route::post('/store', [DoctorController::class, 'doctorStore'])->name('doctor.store');
        Route::get('/edit/{id}/{slug}', [DoctorController::class, 'doctorEdit'])->name('doctor.edit');
        Route::post('/update/{id}', [DoctorController::class, 'doctorUpdate'])->name('doctor.update');
        Route::get('/view/{id}/{slug}', [DoctorController::class, 'doctorView'])->name('doctor.view');
        Route::get('/delete/{id}', [DoctorController::class, 'doctorDelete'])->name('doctor.delete');
        Route::get('/active/{id}', [DoctorController::class, 'doctorActive'])->name('doctor.active');
        Route::get('/inactive/{id}', [DoctorController::class, 'doctorInactive'])->name('doctor.inactive');
        //Doctor message routes
        Route::get('/list', [MessageController::class, 'doctorMessagingList'])->name('doctor.list');
        Route::get('/message/{id}', [MessageController::class, 'doctorMessage'])->name('doctor.message');
        Route::post('/message/store/{id}', [MessageController::class, 'doctorMessageStore'])->name('doctor.message.store');
    });

    //Patient routes
    Route::group(['prefix' => 'patient'], function(){
        Route::get('/create', [PatientController::class, 'create'])->name('patient.create');
        Route::get('/manage', [PatientController::class, 'index'])->name('patient.manage');
        Route::post('/store', [PatientController::class, 'store'])->name('patient.store');
        Route::get('/edit/{id}/{slug}', [PatientController::class, 'edit'])->name('patient.edit');
        Route::post('/update/{id}', [PatientController::class, 'update'])->name('patient.update');
        Route::get('/delete/{id}', [PatientController::class, 'delete'])->name('patient.delete');
        Route::get('/prescription/{id}/{slug}', [PatientController::class, 'prescription'])->name('patient.prescription');
    });

    //Nurse routes
    Route::group(['prefix' => 'nurse'], function(){
        Route::get('/create', [NurseController::class, 'create'])->name('nurse.create');
        Route::get('/manage', [NurseController::class, 'index'])->name('nurse.manage');
        Route::post('/store', [NurseController::class, 'store'])->name('nurse.store');
        Route::get('/edit/{id}/{slug}', [NurseController::class, 'edit'])->name('nurse.edit');
        Route::get('/view/{id}/{slug}', [NurseController::class, 'view'])->name('nurse.view');
        Route::get('/active/{id}', [NurseController::class, 'active'])->name('nurse.active');
        Route::get('/inactive/{id}', [NurseController::class, 'inactive'])->name('nurse.inactive');
        Route::post('/update/{id}', [NurseController::class, 'update'])->name('nurse.update');
        Route::get('/delete/{id}', [NurseController::class, 'delete'])->name('nurse.delete');
    });
    
