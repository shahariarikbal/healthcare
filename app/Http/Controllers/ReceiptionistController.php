<?php

namespace App\Http\Controllers;

use App\Constants\Status;
use App\Models\Receptionist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReceiptionistController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.receptionist.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $receptionist = Receptionist::where('email', $request->email)->first();

        // Check if the receptionist is null
        if (!$receptionist) {
            return redirect()->back()->with('error', 'Invalid email address');
        }
        
        // Check if the receptionist is inactive
        if ($receptionist->is_active === Status::INACTIVE) {
            return redirect()->back()->with('error', 'Unable to login. Please contact the admin');
        }

        // Attempt to login
        if (Auth::guard('receptionist')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect('/receptionist/dashboard');
        } else {
            return redirect()->back()->with('error', 'Incorrect password');
        }
    }


    public function index()
    {
        return view('receptionist.master');
    }

    public function logout(Request $request)
    {
        Auth::guard('receptionist')->logout();
        return redirect('/receptionist/login');
    }
}
