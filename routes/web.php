<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DoctorController;
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
    dd("All clear!");
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
    Route::get('/department/create', [DepartmentController::class, 'showDepartmentCreateForm'])->name('department.create');
    Route::get('/department/manage', [DepartmentController::class, 'manageDepartment'])->name('department.manage');
    Route::post('/department/store', [DepartmentController::class, 'store'])->name('department.store');
    Route::get('/department/edit/{id}', [DepartmentController::class, 'edit'])->name('department.edit');
    Route::post('/department/update/{id}', [DepartmentController::class, 'update'])->name('department.update');
    Route::get('/department/delete/{id}', [DepartmentController::class, 'delete'])->name('department.delete');

    //Doctor CRUD route
    Route::get('/doctor/create', [DoctorController::class, 'showDoctorAddForm'])->name('doctor.create');
    Route::get('/doctor/manage', [DoctorController::class, 'doctorManage'])->name('doctor.manage');
    Route::post('/doctor/store', [DoctorController::class, 'doctorStore'])->name('doctor.store');
    Route::get('/doctor/edit/{id}', [DoctorController::class, 'doctorEdit'])->name('doctor.edit');
    Route::post('/doctor/update/{id}', [DoctorController::class, 'doctorUpdate'])->name('doctor.update');
    Route::get('/doctor/view/{id}', [DoctorController::class, 'doctorView'])->name('doctor.view');
    Route::get('/doctor/delete/{id}', [DoctorController::class, 'doctorDelete'])->name('doctor.delete');
    Route::get('/doctor/active/{id}', [DoctorController::class, 'doctorActive'])->name('doctor.active');
    Route::get('/doctor/inactive/{id}', [DoctorController::class, 'doctorInactive'])->name('doctor.inactive');
