<?php

namespace App\Http\Controllers;

use App\Constants\Statics;
use App\Constants\Status;
use App\Http\Requests\DoctorStoreRequest;
use App\Http\Requests\DoctorUpdateRequest;
use App\Models\Department;
use App\Models\Doctor;
use App\Services\DoctorServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        return view('doctor.master');
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
