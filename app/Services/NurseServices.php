<?php

namespace App\Services;

use App\Models\Nurse;
use App\Models\Patient;
use Str;

class NurseServices
{
     //For Image store
    protected function imageStore($request, $imageFieldName)
    {
        $image = $request->file($imageFieldName);
        $imageName = time().'.'.$image->extension();
        $image->move('avatar/', $imageName);

        return $imageName;
    }

    //For Image update
    protected function imageUpdate($request, $imageFieldName, $nurse)
    {
         // Image come from user
         if ($request->hasFile($imageFieldName)) {
              $oldImage = $nurse->avatar;
              if ($oldImage && file_exists(public_path('avatar/' . $oldImage))) {
                   unlink(public_path('avatar/' . $oldImage));
              }
              $image = $request->file($imageFieldName);
              $imageName = time() . '.' . $image->extension();
              $image->move('avatar/', $imageName);
              $nurse->avatar = url('avatar/'.$imageName);

              return $imageName;
         }
         
         return url('avatar/'.$nurse->avatar);
    }

     public function nurseStore($request)
     {
          $imageName = $this->imageStore($request, 'avatar');
          $data = [
               'first_name' => $request->first_name,
               'last_name' => $request->last_name,
               'slug' => Str::slug($request->first_name.' '. $request->last_name),
               'email' => $request->email,
               'phone' => $request->phone,
               'dob' => $request->dob,
               'join_date' => $request->join_date,
               'address' => $request->address,
               'gender' => $request->gender,
               'qualification' => $request->qualification,
               'experience' => $request->experience,
               'blood_group' => $request->blood_group,
               'avatar' => url('avatar/'.$imageName),
          ];

          $newNurse = Nurse::create($data);
     }


    public function getPatientDataForDatatable()
    {
       return Nurse::orderBy('created_at', 'desc')->get();
    }

    public function generateActionButtons($row)
    {
          $editBtn = '';
          $deleteBtn = '';
          
          $viewUrl = route('nurse.view', ['id' => $row->id, 'slug' => $row->slug]);
          if(auth()->guard('web')->check() || auth()->guard('receptionist')->check()){
               $editUrl = route('nurse.edit', ['id' => $row->id,'slug' => $row->slug]);
               $deleteUrl = route('nurse.delete', ['id' => $row->id,'slug' => $row->slug]);
          }
          

          $viewBtn = '<a href="'.$viewUrl.'" class="view view-btn" title="Nurse view"><i class="fa-regular fa-eye"></i></a>';
          if(auth()->guard('web')->check() || auth()->guard('receptionist')->check()){
               $editBtn = '<a href="'.$editUrl.'" class="edit edit-btn" title="Nurse edit"><i class="fa-regular fa-pen-to-square"></i></a>';
               $deleteBtn = '<a href="'.$deleteUrl.'" class="delete delete-btn" title="Nurse delete" onclick="return confirm(&quot;Are you sure delete this nurse ?&quot;)"><i class="fa-regular fa-trash-alt"></i></a>';
          }
          

          return $editBtn . ' ' . $viewBtn . ' ' . $deleteBtn;
     }


     public function nurseUpdate($request, $nurse)
     {
          $imageUpdateName = $this->imageUpdate($request, 'avatar', $nurse);

          $data = [
               'first_name' => $request->first_name,
               'last_name' => $request->last_name,
               'slug' => Str::slug($request->first_name.' '. $request->last_name),
               'email' => $request->email,
               'phone' => $request->phone,
               'dob' => $request->dob,
               'join_date' => $request->join_date,
               'address' => $request->address,
               'gender' => $request->gender,
               'qualification' => $request->qualification,
               'experience' => $request->experience,
               'blood_group' => $request->blood_group,
          ];

          $nurse->update($data);
     }
     

}