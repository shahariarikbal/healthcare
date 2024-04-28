<?php

namespace App\Http\Controllers;

use App\Constants\Status;
use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
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
        if ($account->is_active === Status::INACTIVE) {
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
        return view('account.master');
    }

    public function logout(Request $request)
    {
        Auth::guard('account')->logout();
        return redirect('/account/login');
    }
}
