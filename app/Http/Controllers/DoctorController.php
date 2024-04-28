<?php

namespace App\Http\Controllers;

use App\Constants\Status;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DoctorController extends Controller
{

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

        // Check if the doctor is null
        if (!$doctor) {
            return redirect()->back()->with('error', 'Invalid email address');
        }
        
        // Check if the doctor is inactive
        if ($doctor->is_active === Status::INACTIVE) {
            return redirect()->back()->with('error', 'Unable to login. Please contact the admin');
        }

        // Attempt to login
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
}
