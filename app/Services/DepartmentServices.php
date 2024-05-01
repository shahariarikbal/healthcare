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
}