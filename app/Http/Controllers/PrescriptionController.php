<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PrescriptionController extends Controller
{
    //******* For Doctor view *******/
    public function addPrescription()
    {
        $doctor = auth()->guard('doctor')->check() ? auth()->guard('doctor')->user() : '';

        $qualifications = explode(',', $doctor->qualification);
        
        if(!$doctor){
            return redirect()->back()->with('error', 'Unauthorized doctor');
        }
        $appointments = Appointment::with(['patient', 'doctor'])->where('doctor_id', $doctor->id)
                    ->where('is_pay', 1)
                    ->whereDate('appointment_date', Carbon::today())
                    ->get();
        return view('admin.pages.prescriptions.add-prescriptions', compact('appointments', 'doctor', 'qualifications'));
    }

    public function showAllPrescriptions()
    {
        return view('admin.pages.prescriptions.doctor-all-prescriptions');
    }

    public function showTodayPrescriptions()
    {
        return view('admin.pages.prescriptions.doctor-today-prescriptions');
    }

    //******* For Admin view *******/
    
    public function allPrescriptions()
    {
        return view('admin.pages.prescriptions.all-prescriptions');
    }

    public function dailyPrescriptions()
    {
        return view('admin.pages.prescriptions.daily-prescriptions');
    }
}
