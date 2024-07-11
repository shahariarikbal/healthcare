<?php

namespace App\Http\Controllers;

use App\Constants\Statics;
use App\Http\Requests\AppointmentUpdateRequest;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use App\Services\AppointmentServices;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AppointmentController extends Controller
{
    protected $appointmentServices;

    public function __construct(AppointmentServices $appointmentServices)
    {
        $this->appointmentServices = $appointmentServices;
    }

    public function appointmentCreateForm()
    {
        $doctors = Doctor::orderBy('id', 'desc')->where('is_active', Statics::ACTIVE)->get();
        $patients = Patient::orderBy('id', 'desc')->get();
        return view('admin.pages.appointments.add', compact('doctors', 'patients'));
    }

    public function appointmentStore(AppointmentUpdateRequest $request)
    {
        try{
            $this->appointmentServices->appointmentStore($request);
            return redirect()->route('appointment.all')->with('success', 'Appointment has been created');
        }catch(Exception $exception){
            Log::error('Appointment store error is:', ['error' => $exception->getMessage()]);
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    public function allAppointments()
    {
        if (request()->ajax()) {
            $data = $this->appointmentServices->getAppointmentDataForDatatable();
            $dataWithActions = $data->map(function ($row) {
                $row->action = $this->appointmentServices->generateActionButtons($row);
                return $row;
            });
            return datatables()->of($dataWithActions)->make(true);
        }

        return view('admin.pages.appointments.all-appointments');
    }

    public function scheduleAppointments()
    {
        if (request()->ajax()) {
            $data = $this->appointmentServices->getScheduleAppointmentDataForDatatable();
            $dataWithActions = $data->map(function ($row) {
                $row->action = $this->appointmentServices->generateScheduleActionButtons($row);
                return $row;
            });
            return datatables()->of($dataWithActions)->make(true);
        }

        return view('admin.pages.appointments.schedule-appointments');
    }

    public function dailyAppointments()
    {
        if(request()->ajax()){
            $data = $this->appointmentServices->getDailyAppointmentDataForDatatable();
            $dailyDataWithActions = $data->map(function($row){
                $row->action = $this->appointmentServices->generateDailyActionButtons($row);
                return $row;
            });

            return datatables()->of($dailyDataWithActions)->make(true);
        }
        return view('admin.pages.appointments.daily-appointments');
    }

    public function editAppointments($id)
    {
        $appointment = Appointment::findOrFail($id);
        $doctors = Doctor::orderBy('id', 'desc')->where('is_active', Statics::ACTIVE)->get();
        $patients = Patient::orderBy('id', 'desc')->get();
        return view('admin.pages.appointments.edit', compact(['appointment', 'doctors', 'patients']));
    }

    public function updateAppointment(AppointmentUpdateRequest $request, $id)
    {
        try{
            $this->appointmentServices->appointmentUpdate($request, $id);
            return redirect()->route('appointment.all')->with('success', 'Appointment has been updated');
        }catch(Exception $exception){
            Log::error('Appointment error is:', ['error' => $exception->getMessage()]);
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    //for daily appointment
    public function dailyAppointmentEdit($id)
    {
        $appointment = Appointment::findOrFail($id);
        $doctors = Doctor::orderBy('id', 'desc')->where('is_active', Statics::ACTIVE)->get();
        $patients = Patient::orderBy('id', 'desc')->get();
        return view('admin.pages.appointments.daily-edit', compact(['appointment', 'doctors', 'patients']));
    }

    public function dailyAppointmentUpdate(AppointmentUpdateRequest $request, $id)
    {
        try{
            $this->appointmentServices->dailyAppointmentUpdate($request, $id);
            return redirect()->route('appointment.daily')->with('success', 'Appointment has been updated');
        }catch(Exception $exception){
            Log::error('Appointment update error is:', ['error' => $exception->getMessage()]);
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    //Overall delete method

    public function appointmentDelete($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->delete();
        return redirect()->back()->with('success', 'Appointment has been deleted');
    }
}
