<?php

namespace App\Http\Controllers;

use App\Constants\Statics;
use App\Constants\Status;
use App\Http\Requests\NurseStoreRequest;
use App\Http\Requests\NurseUpdateRequest;
use App\Models\Nurse;
use App\Services\NurseServices;
use Illuminate\Http\Request;

class NurseController extends Controller
{
    protected $nurseService;

    public function __construct(NurseServices $nurseService)
    {
        $this->nurseService = $nurseService;
    }

    public function create()
    {
        return view('admin.pages.nurse.add');
    }

    public function index()
    {
        if (request()->ajax()) {
            $data = $this->nurseService->getPatientDataForDatatable();
            $dataWithActions = $data->map(function ($row) {
                $row->action = $this->nurseService->generateActionButtons($row);
                return $row;
            });
            return datatables()->of($dataWithActions)->make(true);
        }
        return view('admin.pages.nurse.manage');
    }

    public function store(NurseStoreRequest $request)
    {
        $this->nurseService->nurseStore($request);
        return redirect()->route('nurse.manage')->with('success', 'Nurse has been created');
    }

    public function edit($id)
    {
        $nurse = Nurse::findOrFail($id);
        return view('admin.pages.nurse.edit', compact('nurse'));
    }

    public function view($id)
    {
        $nurse = Nurse::findOrFail($id);
        return view('admin.pages.nurse.view', compact('nurse'));
    }

    public function update(NurseUpdateRequest $request, $id)
    {
        $nurse = Nurse::findOrFail($id);
        $this->nurseService->nurseUpdate($request, $nurse);
        return redirect()->route('nurse.manage')->with('success', 'Nurse has been updated');
    }

    public function active($id)
    {
        $nurse = Nurse::findOrFail($id);
        $nurse->is_active = Statics::INACTIVE;
        $nurse->save();
        return redirect()->route('nurse.manage')->with('success', 'Nurse has been inactivated');
    }

    public function inactive($id)
    {
        $nurse = Nurse::findOrFail($id);
        $nurse->is_active = Statics::ACTIVE;
        $nurse->save();
        return redirect()->route('nurse.manage')->with('success', 'Nurse has been activated');
    }

    public function delete($id)
    {
        $nurse = Nurse::findOrFail($id);
        $nurse->delete();
        return redirect()->route('nurse.manage')->with('success', 'Nurse has been deleted');
    }
}
