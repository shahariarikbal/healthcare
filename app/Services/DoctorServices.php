<?php

namespace App\Services;

use App\Constants\Status;
use App\Models\Doctor;

class DoctorServices
{
     public function doctorStore($request)
     {
          $imageName = $this->imageStore($request, 'avatar');

          $data = [
               'department_id' => $request->department_id,
               'first_name' => $request->first_name,
               'last_name' => $request->last_name,
               'email' => $request->email,
               'password' => bcrypt($request->password),
               'phone' => $request->phone,
               'gender' => $request->gender,
               'fee' => $request->fee,
               'qualification' => $request->qualification,
               'experience' => $request->experience,
               'address' => $request->address,
               'about' => $request->about,
               'avatar' => url('avatar/'.$imageName),
          ];

          $newDoctor = Doctor::create($data);
     }

     //For Image store
    protected function imageStore($request, $imageFieldName)
    {
        $image = $request->file($imageFieldName);
        $imageName = time().'.'.$image->extension();
        $image->move('avatar/', $imageName);

        return $imageName;
    }


    public function getDoctorDataForDatatable()
    {
       return Doctor::with('department')->orderBy('created_at', 'desc')->get();
    }

    public function generateActionButtons($row)
    {
          $viewUrl = route('doctor.view', ['id' => $row->id]);
          $editUrl = route('doctor.edit', ['id' => $row->id]);
          $deleteUrl = route('doctor.delete', ['id' => $row->id]);

          $viewBtn = '<a href="'.$viewUrl.'" class="view view-btn"><i class="fa-regular fa-eye"></i></a>';
          $editBtn = '<a href="'.$editUrl.'" class="edit edit-btn"><i class="fa-regular fa-pen-to-square"></i></a>';
          $deleteBtn = '<a href="'.$deleteUrl.'" class="delete delete-btn" onclick="return confirm(&quot;Are you sure delete this doctor ?&quot;)"><i class="fa-regular fa-trash-alt"></i></a>';

          

          return $editBtn . ' ' . $viewBtn . ' ' . $deleteBtn;
     }


     public function doctorUpdate($request, $doctor)
     {
          $imageUpdateName = $this->imageUpdate($request, 'avatar', $doctor);

          $data = [
               'department_id' => $request->department_id,
               'first_name' => $request->first_name,
               'last_name' => $request->last_name,
               'email' => $request->email,
               'password' => bcrypt($request->password),
               'phone' => $request->phone,
               'gender' => $request->gender,
               'fee' => $request->fee,
               'qualification' => $request->qualification,
               'experience' => $request->experience,
               'address' => $request->address,
               'about' => $request->about,
          ];

          $doctor->update($data);
     }

     //For Image update
     protected function imageUpdate($request, $imageFieldName, $doctor)
     {
          // Check if a new image file is provided
          if ($request->hasFile($imageFieldName)) {
               $oldImage = $doctor->avatar;
               if ($oldImage && file_exists(public_path('avatar/' . $oldImage))) {
                    unlink(public_path('avatar/' . $oldImage));
               }
               $image = $request->file($imageFieldName);
               $imageName = time() . '.' . $image->extension();
               $image->move('avatar/', $imageName);
               $doctor->avatar = url('avatar/'.$imageName);

               return $imageName;
          }
          
          // If no new image file is provided, return the current avatar name
          return url('avatar/'.$doctor->avatar);
     }

     

}