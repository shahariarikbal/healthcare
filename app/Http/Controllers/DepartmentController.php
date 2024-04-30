<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function showDepartmentCreateForm()
    {
        return view('admin.pages.department.add');
    }

    public function manageDepartment()
    {
        return view('admin.pages.department.manage');
    }


    public function departmentStore(Request $request)
    {
        //
    }

    public function departmentEdit(Department $department)
    {
        //
    }

    public function departmentUpdate(Request $request)
    {
        //
    }

    public function departmentDelete($id)
    {
        //
    }
}
