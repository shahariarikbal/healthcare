<?php

namespace App\Http\Controllers;

use App\Constants\Status;
use App\Http\Requests\AppointmentUpdateRequest;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use App\Services\AdminServices;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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

    public function editAppointments($id)
    {
        $appointment = Appointment::findOrFail($id);
        $doctors = Doctor::orderBy('id', 'desc')->where('is_active', Status::ACTIVE)->get();
        $patients = Patient::orderBy('id', 'desc')->get();
        return view('admin.pages.appointments.edit', compact(['appointment', 'doctors', 'patients']));
    }

    public function updateAppointment(AppointmentUpdateRequest $request, $id)
    {
        try{
            $this->adminServices->appointmentUpdate($request, $id);
            return redirect()->route('all.appointments')->with('success', 'Appointment has been updated');
        }catch(Exception $exception){
            Log::error('Appointment error is:', ['error' => $exception->getMessage()]);
            return redirect()->back()->with('error', $exception->getMessage());
        }
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
