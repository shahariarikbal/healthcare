<?php

namespace App\Http\Controllers;

use App\Constants\Statics;
use App\Constants\Status;
use App\Http\Requests\DoctorProfileUpdateRequest;
use App\Http\Requests\DoctorStoreRequest;
use App\Http\Requests\DoctorUpdateRequest;
use App\Models\Department;
use App\Models\Doctor;
use App\Services\DoctorServices;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DoctorController extends Controller
{
    protected $doctorServices;
    public function __construct(DoctorServices $doctorServices)
    {
        $this->doctorServices = $doctorServices;
    }

    public function showLoginForm()
    {
        return view('auth.doctor.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $doctor = Doctor::where('email', $request->email)->first();

        // if the doctor is null
        if (!$doctor) {
            return redirect()->back()->with('error', 'Invalid email address');
        }
        
        // if the doctor is inactive
        if ($doctor->is_active === Statics::INACTIVE) {
            return redirect()->back()->with('error', 'Unable to login. Please contact the admin');
        }

        // Attempt to the login
        if (Auth::guard('doctor')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect('/doctor/dashboard');
        } else {
            return redirect()->back()->with('error', 'Incorrect password');
        }
    }


    public function index()
    {
        $doctors = $this->doctorServices->totalDoctorCount();
        $appointment = $this->doctorServices->appointmentCount();
        return view('doctor.home.index', compact(['doctors', 'appointment']));
    }

    public function profileSetting()
    {
        $authUser = auth()->guard('doctor')->user();
        return view('doctor.profile.settings', compact('authUser'));
    }

    public function profileSettingUpdate(DoctorProfileUpdateRequest $request)
    {
        $profileUpdate = $this->doctorServices->profileUpdate($request);
        return redirect()->back()->with('success', 'Profile has been updated');
    }

    public function profilePasswordUpdate(Request $request)
    {
        $this->validate($request, [
            'old_password' => 'required|min:8',
            'password' => 'required|confirmed|min:8'
        ]);

        try{
            $authUser = auth()->guard('doctor')->user();

            if(!Hash::check($request->old_password, $authUser->password)){
                return redirect()->back()->with('error', 'The provided password does not match your current password.');
            }

            //update password
            $authUser->update([
                'password' => Hash::make($request->password)
            ]);
            return redirect()->back()->with('success', 'Password has been updated.');
        }catch(ModelNotFoundException $exception){
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    public function doctorLogout(Request $request)
    {
        Auth::guard('doctor')->logout();
        return redirect('/doctor/login');
    }


    // Doctor CRUD operation
    public function showDoctorAddForm()
    {
        $departments = Department::all();
        return view('admin.pages.doctor.add', compact('departments'));
    }

    public function doctorStore(DoctorStoreRequest $request)
    {
        $newDoctor = $this->doctorServices->doctorStore($request);
        return redirect()->route('doctor.manage')->with('success', 'Doctor has been created');
    }

    public function doctorManage()
    {
        if (request()->ajax()) {
            $data = $this->doctorServices->getDoctorDataForDatatable();
            $dataWithActions = $data->map(function ($row) {
                $row->action = $this->doctorServices->generateActionButtons($row);
                return $row;
            });
            return datatables()->of($dataWithActions)->make(true);
        }
        return view('admin.pages.doctor.manage');
    }

    public function doctorEdit($id)
    {
        $doctor = Doctor::findOrFail($id);
        $departments = Department::all();
        return view('admin.pages.doctor.edit', compact('doctor', 'departments'));
    }

    public function doctorView($id)
    {
        $doctor = Doctor::with('department')->findOrFail($id);
        return view('admin.pages.doctor.view', compact('doctor'));
    }

    public function doctorUpdate(DoctorUpdateRequest $request, $id)
    {
        $doctor = Doctor::findOrFail($id);
        $this->doctorServices->doctorUpdate($request, $doctor);
        return redirect()->route('doctor.manage')->with('success', 'Doctor has been updated');
    }

    public function doctorActive($id)
    {
        $doctor = Doctor::findOrFail($id);
        $doctor->is_active = Statics::INACTIVE;
        $doctor->save();
        return redirect()->route('doctor.manage')->with('success', 'Doctor has been inactivated');
    }

    public function doctorInactive($id)
    {
        $doctor = Doctor::findOrFail($id);
        $doctor->is_active = Statics::ACTIVE;
        $doctor->save();
        return redirect()->route('doctor.manage')->with('success', 'Doctor has been Activated');
    }

    public function doctorDelete($id)
    {
        $doctor = Doctor::findOrFail($id);
        $doctor->delete();
        return redirect()->route('doctor.manage')->with('success', 'Doctor has been deleted');
    }
}
