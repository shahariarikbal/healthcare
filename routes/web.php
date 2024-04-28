<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
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
