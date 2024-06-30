<?php

namespace App\Http\Controllers;

class AdminController extends Controller
{
    
    public function allPrescriptions()
    {
        return view('admin.pages.prescriptions.all-prescriptions');
    }

    public function dailyPrescriptions()
    {
        return view('admin.pages.prescriptions.daily-prescriptions');
    }
}
