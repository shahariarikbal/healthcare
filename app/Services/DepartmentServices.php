<?php

namespace App\Services;

use App\Models\Department;
use Illuminate\Support\Str;

class DepartmentServices
{
    public function store($request)
    {
          foreach($request->name as $k => $name){
               Department::create([
                    'name' => $request->name[$k],
                    'slug' => Str::slug($request->name[$k])
               ]);
          }
          
    }

    public function update($request, $id)
    {
       $department = Department::find($id);
       $department->update([
          'name' => $request->name,
          'slug' => Str::slug($request->name)
       ]);
    }

    public function getDataForDataTable()
    {
        return Department::select('*')->orderBy('id', 'desc')->get();
    }

    public function generateActionButtons($row)
    {
        $editUrl = route('department.edit', ['id' => $row->id, 'slug' => $row->slug]);
        $deleteUrl = route('department.delete', ['id' => $row->id]);
        $editBtn = '<a href="'.$editUrl.'" class="edit btn edit-btn"><i class="fa-regular fa-pen-to-square"></i></a>';
        $deleteBtn = '<a href="'.$deleteUrl.'" class="delete btn delete-btn" onclick="return confirm(&quot;Are you sure delete this department ?&quot;)"><i class="fa-regular fa-trash-alt"></i></a>';
        return $editBtn . ' ' . $deleteBtn;
    }
}