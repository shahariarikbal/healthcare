<?php

namespace App\Http\Controllers;

use App\Constants\Statics;
use App\Http\Requests\AccountsStoreRequest;
use App\Http\Requests\AccountsUpdateRequest;
use App\Models\Account;
use App\Services\AccountsServices;
use App\Services\AppointmentServices;
use App\Services\DoctorServices;
use App\Services\ExpanseService;
use App\Services\PatientServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    protected $accountServices;
    protected $appointmentServices;
    protected $expanseServices;
    protected $doctorServices;
    protected $patientServices;

    public function __construct(AccountsServices $accountServices, AppointmentServices $appointmentServices, ExpanseService $expanseService, DoctorServices $doctorServices, PatientServices $patientServices)
    {
        $this->accountServices = $accountServices;
        $this->appointmentServices = $appointmentServices;
        $this->expanseServices = $expanseService;
        $this->doctorServices = $doctorServices;
        $this->patientServices = $patientServices;
    }


    public function showLoginForm()
    {
        return view('auth.account.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $account = Account::where('email', $request->email)->first();

        // Check if the account is null
        if (!$account) {
            return redirect()->back()->with('error', 'Invalid email address');
        }
        
        // Check if the account is inactive
        if ($account->is_active === Statics::INACTIVE) {
            return redirect()->back()->with('error', 'Unable to login. Please contact the admin');
        }

        // Attempt to login
        if (Auth::guard('account')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect('/account/dashboard');
        } else {
            return redirect()->back()->with('error', 'Incorrect password');
        }
    }


    public function index()
    {
        $data = [
            'totalSecheduleAppointment' => $this->appointmentServices->getTotalScheduleAppointmentDataForDatatable(),
            'todayTotalBillCollect' => $this->accountServices->todayTotalBillCollect(),
            'totalBillCollect' => $this->accountServices->totalBillCollect(),
            'todayTotalExpanse' => $this->expanseServices->todayTotalExpanse(),
            'monthlyTotalExpanse' => $this->expanseServices->monthlyTotalExpanse(),
            'totalExpanse' => $this->expanseServices->totalExpanse(),
            'totalBalanceReports' => $this->accountServices->totalBalanceReport(),
            'totalAppointments' => $this->appointmentServices->totalAppointmentCount(),
            'todayAppointments' => $this->appointmentServices->todayTotalAppointmentCount(),
            'totalDoctors' => $this->doctorServices->totalDoctorCount(),
            'totalPatients' => $this->patientServices->totalPatientCount()
        ];
        return view('account.home.index', compact('data'));
    }

    public function profileSetting()
    {
        $authUser = auth()->guard('account')->user();
        return view('account.profile.settings', compact('authUser'));
    }

    public function profileSettingUpdate(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'phone' => 'required|string|unique:accounts,phone,'.auth()->guard('account')->user()->id,
            'email' => 'required|email|unique:accounts,email,'.auth()->guard('account')->user()->id
        ]);

        try{
            $authUser = auth()->guard('account')->user();
            if ($request->hasFile('avatar')) {
                $oldImage = $authUser->avatar;
                if ($oldImage && file_exists(public_path('logo/' . $oldImage))) {
                     unlink(public_path('logo/' . $oldImage));
                }
                $image = $request->file('avatar');
                $imageName = time() . '.' . $image->extension();
                $image->move('logo/', $imageName);
                $authUser->avatar = url('logo/'.$imageName);
 
                $authUser->update();
                
         }

            $authUser->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'email' => $request->email,
            ]);

            return redirect()->back()->with('success', 'Profile setting has been updated');
            
        }catch(Exception $exception){
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    public function passwordUpdate(Request $request)
    {
        $this->validate($request, [
            'old_password' => 'required|min:8',
            'password' => 'required|confirmed|min:8'
        ]);

        try{
            $authUser = auth()->guard('account')->user();

            if(!Hash::check($request->old_password, $authUser->password)){
                return redirect()->back()->with('error', 'The provided password does not match your current password.');
            }

            //update password
            $authUser->update([
                'password' => Hash::make($request->password)
            ]);
            return redirect()->back()->with('success', 'Password has been updated.');
        }catch(Exception $exception){
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('account')->logout();
        return redirect('/account/login');
    }


    // Account CRUD operation
    public function accountsCreate()
    {
        return view('admin.pages.accounts.add');
    }

    public function accountsStore(AccountsStoreRequest $request)
    {
        $newUser = $this->accountServices->accountsStore($request);
        return redirect()->route('accounts.manage')->with('success', 'Account has been created');
    }

    public function accountsManage()
    {
        if (request()->ajax()) {
            $data = $this->accountServices->getAccountsDataForDatatable();
            $dataWithActions = $data->map(function ($row) {
                $row->action = $this->accountServices->generateActionButtons($row);
                return $row;
            });
            return datatables()->of($dataWithActions)->make(true);
        }
        return view('admin.pages.accounts.manage');
    }

    public function accountsEdit($id)
    {
        $accounts = Account::findOrFail($id);
        return view('admin.pages.accounts.edit', compact('accounts'));
    }

    public function accountsView($id)
    {
        $accounts = Account::findOrFail($id);
        return view('admin.pages.accounts.view', compact('accounts'));
    }

    public function accountsUpdate(AccountsUpdateRequest $request, $id)
    {
        $accounts = Account::findOrFail($id);
        $this->accountServices->accountsUpdate($request, $accounts);
        return redirect()->route('accounts.manage')->with('success', 'Account has been updated');
    }

    public function accountsActive($id)
    {
        $accounts = Account::findOrFail($id);
        $accounts->is_active = Statics::INACTIVE;
        $accounts->save();
        return redirect()->route('accounts.manage')->with('success', 'Accounts has been inactivated');
    }

    public function accountsInactive($id)
    {
        $accounts = Account::findOrFail($id);
        $accounts->is_active = Statics::ACTIVE;
        $accounts->save();
        return redirect()->route('accounts.manage')->with('success', 'Accounts has been Activated');
    }

    public function accountsDelete($id)
    {
        $accounts = Account::findOrFail($id);
        $accounts->delete();
        return redirect()->route('accounts.manage')->with('success', 'Accounts has been deleted');
    }
}
