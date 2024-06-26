<?php

namespace App\Http\Controllers;

use App\Constants\Statics;
use App\Http\Requests\BillingStoreRequest;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use App\Services\AppointmentServices;
use App\Services\BillingServices;
use Exception;
use Illuminate\Http\Request;

class BillingController extends Controller
{
    protected $appointmentServices;
    protected $billingServices;

    public function __construct(AppointmentServices $appointmentServices, BillingServices $billingServices)
    {
        $this->appointmentServices = $appointmentServices;
        $this->billingServices = $billingServices;
    }

    public function accountsBillingsManage()
    {
        if (request()->ajax()) {
            $data = $this->appointmentServices->getAppointmentDataForDatatable();
            $dataWithActions = $data->map(function ($row) {
                $row->action = $this->appointmentServices->generateActionButtons($row);
                return $row;
            });
            return datatables()->of($dataWithActions)->make(true);
        }

        return view('admin.pages.billings.list');
    }

    public function accountsBillCollectForm($id)
    {
        $appointment = Appointment::with('doctor', 'patient')->findOrFail($id);
        $doctors = Doctor::orderBy('id', 'desc')->where('is_active', Statics::ACTIVE)->get();
        $patients = Patient::orderBy('id', 'desc')->get();
        return view('admin.pages.billings.add', compact(['appointment', 'doctors', 'patients']));
    }

    public function accountsBillStore(BillingStoreRequest $request, $id)
    {
        try{
            $this->billingServices->billStore($request, $id);
            return redirect()->route('accounts.billing.manage')->with('success', 'Patient bill has been collected');
        }catch(Exception $exception){
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    public function accountsBillingsInvoice()
    {
        
    }
}
