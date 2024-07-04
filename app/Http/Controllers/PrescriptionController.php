<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PrescriptionController extends Controller
{
    public function addPrescription()
    {
        return view('admin.pages.prescriptions.add-prescriptions');
    }
    
    public function allPrescriptions()
    {
        return view('admin.pages.prescriptions.all-prescriptions');
    }

    public function dailyPrescriptions()
    {
        return view('admin.pages.prescriptions.daily-prescriptions');
    }
}
