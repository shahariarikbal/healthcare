<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
    }
}
