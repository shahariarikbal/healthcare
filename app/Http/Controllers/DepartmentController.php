<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Services\DepartmentServices;
use Illuminate\Http\Request;
use DataTables;

class DepartmentController extends Controller
{
    protected $departments;
    public function __construct(DepartmentServices $departmentServices)
    {
        $this->departments = $departmentServices;
    }

    public function showDepartmentCreateForm()
    {
        return view('admin.pages.department.add');
    }

    public function manageDepartment()
    {
        if (request()->ajax()) {
            $data = $this->departments->getDataForDataTable();
            $dataWithActions = $data->map(function ($row) {
                $row->action = $this->departments->generateActionButtons($row);
                return $row;
            });
            return datatables()->of($dataWithActions)->make(true);
        }
        return view('admin.pages.department.manage');
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name.*' => 'required|max:255|unique:departments,name|filled'
        ], [
            'name.*.required' => 'Department name field is required',
            'name.*.max' => 'Department name field must not exceed 255 characters',
            'name.*.unique' => 'Department name field must be unique',
            'name.*.filled' => 'Department name field must not be empty'
        ]);

        $this->departments->store($request);
        return redirect()->route('department.manage')->with('success', 'Department has been created');


    }

    public function edit($id, $slug)
    {
        $department = Department::findOrFail($id);
        return view('admin.pages.department.edit', compact('department'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|max:255|filled'
        ], [
            'name.required' => 'Department name field is required'
        ]);
        $this->departments->update($request, $id);
        return redirect()->route('department.manage')->with('success', 'Department has been updated');
    }

    public function delete($id)
    {
        $department = Department::find($id);
        $department->delete();
        return redirect()->route('department.manage')->with('success', 'Department has been deleted');
    }
}
