<?php

namespace App\Http\Controllers;

use App\Services\AdminServices;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    protected $adminServices;

    public function __construct(AdminServices $adminServices)
    {
        $this->adminServices = $adminServices;
    }

    public function allAppointments()
    {
        if (request()->ajax()) {
            $data = $this->adminServices->getAppointmentDataForDatatable();
            $dataWithActions = $data->map(function ($row) {
                $row->action = $this->adminServices->generateActionButtons($row);
                return $row;
            });
            return datatables()->of($dataWithActions)->make(true);
        }

        return view('admin.pages.appointments.all-appointments');
    }

    public function dailyAppointments()
    {
        return view('admin.pages.appointments.daily-appointments');
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
