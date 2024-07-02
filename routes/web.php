<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\ExpanseController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\NurseController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ReceptionistController;
use App\Http\Controllers\SmtpSettingController;
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
    'register' => false, 
    'reset' => false,
    'verify' => false,
  ]);

  Route::get('invoice', function (){
    return view('admin.pages.billings.receipt');
});

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
        
    });

    //Patient routes
    Route::group(['prefix' => 'patient'], function(){
        Route::get('/create', [PatientController::class, 'create'])->name('patient.create');
        Route::get('/manage', [PatientController::class, 'index'])->name('patient.manage');
        Route::post('/store', [PatientController::class, 'store'])->name('patient.store');
        Route::get('/edit/{id}/{slug}', [PatientController::class, 'edit'])->name('patient.edit');
        Route::post('/update/{id}', [PatientController::class, 'update'])->name('patient.update');
        Route::get('/delete/{id}', [PatientController::class, 'delete'])->name('patient.delete');
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

     //Receptionist routes
     Route::group(['prefix' => 'reception'], function(){
        Route::get('/create', [ReceptionistController::class, 'receptionCreate'])->name('reception.create');
        Route::get('/manage', [ReceptionistController::class, 'receptionManage'])->name('reception.manage');
        Route::post('/store', [ReceptionistController::class, 'receptionStore'])->name('reception.store');
        Route::get('/edit/{id}/{slug}', [ReceptionistController::class, 'receptionEdit'])->name('reception.edit');
        Route::get('/view/{id}/{slug}', [ReceptionistController::class, 'receptionView'])->name('reception.view');
        Route::get('/active/{id}', [ReceptionistController::class, 'receptionActive'])->name('reception.active');
        Route::get('/inactive/{id}', [ReceptionistController::class, 'receptionInactive'])->name('reception.inactive');
        Route::post('/update/{id}', [ReceptionistController::class, 'receptionUpdate'])->name('reception.update');
        Route::get('/delete/{id}', [ReceptionistController::class, 'receptionDelete'])->name('reception.delete');
    });


     //Accounts routes
     Route::group(['prefix' => 'accounts'], function(){
        Route::get('/create', [AccountController::class, 'accountsCreate'])->name('accounts.create');
        Route::get('/manage', [AccountController::class, 'accountsManage'])->name('accounts.manage');
        Route::post('/store', [AccountController::class, 'accountsStore'])->name('accounts.store');
        Route::get('/edit/{id}/{slug}', [AccountController::class, 'accountsEdit'])->name('accounts.edit');
        Route::get('/view/{id}/{slug}', [AccountController::class, 'accountsView'])->name('accounts.view');
        Route::get('/active/{id}', [AccountController::class, 'accountsActive'])->name('accounts.active');
        Route::get('/inactive/{id}', [AccountController::class, 'accountsInactive'])->name('accounts.inactive');
        Route::post('/update/{id}', [AccountController::class, 'accountsUpdate'])->name('accounts.update');
        Route::get('/delete/{id}', [AccountController::class, 'accountsDelete'])->name('accounts.delete');

        //expanse routes
        Route::get('/expanse-manage', [ExpanseController::class, 'expanseManage'])->name('accounts.expanse.manage');
        Route::get('/expanse-create', [ExpanseController::class, 'expanseCreate'])->name('accounts.expanse.create');
        Route::post('/expanse-store', [ExpanseController::class, 'expanseStore'])->name('accounts.expanse.store');
        Route::get('/expanse-edit/{id}', [ExpanseController::class, 'expanseEdit'])->name('accounts.expanse.edit');
        Route::post('/expanse-update/{id}', [ExpanseController::class, 'expanseUpdate'])->name('accounts.expanse.update');
        Route::get('/expanse-delete/{id}', [ExpanseController::class, 'expanseDelete'])->name('accounts.expanse.delete');

        //Invoice
        Route::get('/invoice-manage', [BillingController::class, 'invoiceManage'])->name('accounts.invoice.manage');
        Route::get('/invoice-download/{id}', [BillingController::class, 'invoiceDownload'])->name('accounts.invoice.download');

        //Payment report route
        Route::get('/payment-report-manage', [BillingController::class, 'paymentReportManage'])->name('accounts.payment.report.manage');

        //Billings routes
        Route::get('/billing-manage', [BillingController::class, 'accountsBillingsManage'])->name('accounts.billing.manage');
        Route::get('/bill-collect-form/{id}', [BillingController::class, 'accountsBillCollectForm'])->name('accounts.bill.collect');
        Route::post('/patient-bill-store/{id}', [BillingController::class, 'accountsBillStore'])->name('accounts.bill.store');
        Route::get('/billing-invoices', [BillingController::class, 'accountsBillingsInvoice'])->name('accounts.billing.invoice');
        

        
    });

    Route::group(['prefix' => 'appointment'], function(){
        Route::get('/create', [AppointmentController::class, 'appointmentCreateForm'])->name('appointment.create');
        Route::post('/store', [AppointmentController::class, 'appointmentStore'])->name('appointment.store');
        Route::get('/all-list', [AppointmentController::class, 'allAppointments'])->name('appointment.all');
        Route::get('/view/{id}', [AppointmentController::class, 'viewAppointment'])->name('appointment.view');
        Route::get('/edit/{id}', [AppointmentController::class, 'editAppointments'])->name('appointment.edit');
        Route::post('/update/{id}', [AppointmentController::class, 'updateAppointment'])->name('appointment.update');
        
        Route::get('/daily-appointments-list', [AppointmentController::class, 'dailyAppointments'])->name('appointment.daily');
        Route::get('/daily-appointments-edit/{id}', [AppointmentController::class, 'dailyAppointmentEdit'])->name('appointment.daily.edit');
        Route::post('/daily-appointments-update/{id}', [AppointmentController::class, 'dailyAppointmentUpdate'])->name('appointment.daily.update');
    
        
    });

    //prescriptions route
    Route::group(['prefix' => 'prescription'], function(){
        Route::get('/list', [AdminController::class, 'allPrescriptions'])->name('prescription.all');
        Route::get('/daily-list', [AdminController::class, 'dailyPrescriptions'])->name('prescription.daily');
    });

    //messageing
    Route::group(['prefix' => 'message'], function(){
        //accounts message routes
        Route::get('/accounts', [MessageController::class, 'accountsMessagingList'])->name('message.accounts.index');
        Route::get('/accounts/{id}', [MessageController::class, 'accountsMessageShow'])->name('message.accounts.show');
        Route::post('/accounts/{id}', [MessageController::class, 'accountsMessageStore'])->name('message.accounts.store');

        //reception message routes
        Route::get('/receptionists', [MessageController::class, 'receptionMessagingList'])->name('message.receptionist.index');
        Route::get('/receptionist/{id}', [MessageController::class, 'receptionMessage'])->name('message.receptionist.show');
        Route::post('/receptionist/{id}', [MessageController::class, 'receptionMessageStore'])->name('message.receptionist.store');

        //Doctor message routes
        Route::get('/doctors', [MessageController::class, 'doctorMessagingList'])->name('message.doctors.index');
        Route::get('/doctors/{id}', [MessageController::class, 'showDoctorMessage'])->name('message.doctor.show');
        Route::post('/doctors/{id}', [MessageController::class, 'doctorMessageStore'])->name('message.doctor.store');
    });

    //Email routes
    Route::group(['prefix' => 'email'], function(){
        Route::get('/create', [EmailController::class, 'emailCreate'])->name('email.create');
        Route::post('/send', [EmailController::class, 'emailSend'])->name('email.send');
        Route::get('/manage', [EmailController::class, 'sendingEmailShow'])->name('email.manage');
        Route::get('/view/{id}', [EmailController::class, 'sendingEmailDetails'])->name('email.view');
        Route::get('/delete/{id}', [EmailController::class, 'sendingEmailDelete'])->name('email.delete');
    });

    //SMTP Settings routes
    Route::group(['prefix' => 'smtp'], function(){
        Route::get('/setting', [SmtpSettingController::class, 'showSmtpForm'])->name('smtp.setting');
        Route::post('/setting-store', [SmtpSettingController::class, 'smtpStore'])->name('smtp.setting.store');
    });
    
    
