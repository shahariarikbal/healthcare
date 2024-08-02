<?php

namespace App\Http\Controllers;

use App\Http\Requests\PrescriptionStoreRequest;
use App\Models\Appointment;
use App\Models\Instruction;
use App\Services\PrescriptionServices;
use PDF;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class PrescriptionController extends Controller
{
    protected $prescriptionService;

    public function __construct(PrescriptionServices $prescriptionService)
    {
        $this->prescriptionService = $prescriptionService;
    }

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

    public function authUserPrescriptions()
    {
        if(request()->ajax()){
            $data = $this->prescriptionService->showAuthDoctorPrescriptions();
            
            $dataWithAction = $data->map(function($row){
                $row->action = $this->prescriptionService->generateActionButtons($row);
                return $row;
            });
            return datatables()->of($dataWithAction)->make(true);
        }

        return view('admin.pages.prescriptions.doctor-all-prescriptions');
    }

    public function viewPrescriptions(Instruction $instruction)
    {
        return view('admin.pages.prescriptions.prescriptions-view', compact('instruction'));
    }

    public function showTodayPrescriptions()
    {
        if(request()->ajax()){
            $data = $this->prescriptionService->showTodayPrescriptions();
            
            $dataWithAction = $data->map(function($row){
                $row->action = $this->prescriptionService->generateActionButtons($row);
                return $row;
            });
            return datatables()->of($dataWithAction)->make(true);
        }
        return view('admin.pages.prescriptions.doctor-today-prescriptions');
    }

    public function downloadPrescriptions(Instruction $instruction)
    {
        $pdf = PDF::loadView('admin.pages.prescriptions.prescriptions-pdf', compact('instruction'));
        return $pdf->download('Prescription.pdf');
    }

    public function prescriptionStore(PrescriptionStoreRequest $request)
    {
        try{
            $prescriptionStore = $this->prescriptionService->store($request);
            return redirect()->back()->with('success', 'Prescription has been created');
        }catch(ModelNotFoundException $exception){
            return redirect()->back()->with('error', $exception->getMessage());
       }catch(Exception $exception){
            return redirect()->back()->with('error', $exception->getMessage());
       }
        
    }

    //Overall delete method
    public function deletePrescriptions(Instruction $instruction)
     {
        $instruction->delete();
        return redirect()->back()->with('success', 'Prescription has been deleted');
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
