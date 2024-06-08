<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $totalAppointments = Appointment::select(['id'])->get()->count();
        $todayAppointments = Appointment::where('appointment_date', Carbon::today())->select(['id'])->get()->count();
        $patients = Patient::select(['id'])->get()->count();
        $doctors = Doctor::select(['id'])->get()->count();
        return view('admin.home.index', compact(['totalAppointments', 'todayAppointments', 'patients', 'doctors']));
    }
}
