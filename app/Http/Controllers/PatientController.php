<?php

namespace App\Http\Controllers;

use App\Http\Requests\PatientStoreRequest;
use App\Services\PatientServices;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    protected $patientService;

    public function __construct(PatientServices $patientService)
    {
        $this->patientService = $patientService;
    }

    public function create()
    {
        return view('admin.pages.patient.add');
    }

    public function index()
    {
        if (request()->ajax()) {
            $data = $this->patientService->getPatientDataForDatatable();
            $dataWithActions = $data->map(function ($row) {
                $row->action = $this->patientService->generateActionButtons($row);
                return $row;
            });
            return datatables()->of($dataWithActions)->make(true);
        }
        return view('admin.pages.patient.manage');
    }

    public function store(PatientStoreRequest $request)
    {
        $this->patientService->patientStore($request);
        return redirect()->route('patient.manage')->with('success', 'Patient has been created');
    }
}
