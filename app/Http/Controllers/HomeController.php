<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Billing;
use App\Models\Doctor;
use App\Models\Patient;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
    public function calculateReport($method, $field, $dataValue)
    {
        return Billing::{$method}($field, $dataValue);
    }

    public function index()
    {
        $totalAppointments = Appointment::select(['id'])->get()->count();
        $todayAppointments = Appointment::where('appointment_date', Carbon::today())->select(['id'])->get()->count();
        $patients = Patient::select(['id'])->get()->count();
        $doctors = Doctor::select(['id'])->get()->count();
        $calculateReports = [
            'yearlyReport' => $this->calculateReport('whereYear', 'payment_date', date('Y'))->sum('fee'),
            'monthlyReport' => $this->calculateReport('whereYear', 'payment_date', date('Y'))
                ->whereMonth('payment_date', date('m'))->sum('fee'),
            'todayReport' => $this->calculateReport('whereDate', 'payment_date', date('Y-m-d'))->sum('fee')
        ];

        //For appointment chart data show
        $monthlyAppointmentData = Appointment::select(
                DB::raw("COUNT(*) as count"), 
                DB::raw("MONTHNAME(appointment_date) as month_name")
            )
            ->whereYear('appointment_date', date('Y'))->groupBy(DB::raw(("MONTH(appointment_date), MONTHNAME(appointment_date)")))
            ->orderBy(DB::raw("MONTH(appointment_date)"))->pluck('count', 'month_name');

        $labels = $monthlyAppointmentData->keys()->toArray();
        $data = $monthlyAppointmentData->values()->toArray();
        return view('admin.home.index', compact(['calculateReports','labels','data','totalAppointments', 'todayAppointments', 'patients', 'doctors']));
    }
}
