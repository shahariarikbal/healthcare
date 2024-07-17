<?php

namespace App\Services;

use App\Models\Nurse;
use App\Models\Patient;
use App\Models\Receptionist;
use Str;

class ReceptionServices
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
    protected function imageUpdate($request, $imageFieldName, $receptionist)
    {
         // Image come from user
         if ($request->hasFile($imageFieldName)) {
              $oldImage = $receptionist->avatar;
              if ($oldImage && file_exists(public_path('avatar/' . $oldImage))) {
                   unlink(public_path('avatar/' . $oldImage));
              }
              $image = $request->file($imageFieldName);
              $imageName = time() . '.' . $image->extension();
              $image->move('avatar/', $imageName);
              $receptionist->avatar = url('avatar/'.$imageName);

              return $imageName;
         }
         
         return url('avatar/'.$receptionist->avatar);
    }

     public function receptionistStore($request)
     {
          $imageName = $this->imageStore($request, 'avatar');
          $data = [
               'first_name' => $request->first_name,
               'last_name' => $request->last_name,
               'slug' => Str::slug($request->first_name.' '. $request->last_name),
               'email' => $request->email,
               'password' => bcrypt($request->password),
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

          $newReceptionist = Receptionist::create($data);
     }


    public function getReceptionistDataForDatatable()
    {
       return Receptionist::orderBy('created_at', 'desc')->get();
    }

    public function generateActionButtons($row)
    {
          $editBtn = '';
          $deleteBtn = '';
          $viewUrl = route('reception.view', ['id' => $row->id, 'slug' => $row->slug]);
          if(auth()->guard('web')->check()){
               $editUrl = route('reception.edit', ['id' => $row->id,'slug' => $row->slug]);
               $deleteUrl = route('reception.delete', ['id' => $row->id,'slug' => $row->slug]);
          }
          

          $viewBtn = '<a href="'.$viewUrl.'" class="view view-btn" title="Receptionist view"><i class="fa-regular fa-eye"></i></a>';
          if(auth()->guard('web')->check()){
               $editBtn = '<a href="'.$editUrl.'" class="edit edit-btn" title="Receptionist edit"><i class="fa-regular fa-pen-to-square"></i></a>';
               $deleteBtn = '<a href="'.$deleteUrl.'" class="delete delete-btn" title="Receptionist delete" onclick="return confirm(&quot;Are you sure delete this receptionist ?&quot;)"><i class="fa-regular fa-trash-alt"></i></a>';
          }
          

          return $editBtn . ' ' . $viewBtn . ' ' . $deleteBtn;
     }

     public function generateMessageActionButton($row)
     {
          $receptionMessageUrl = route('message.receptionist.show', ['id' => $row->id]);

          $receptionMessageBtn = '<a href="'.$receptionMessageUrl.'" class="badge-active">Message</a>';

          return $receptionMessageBtn;
     }


     public function receptionistUpdate($request, $receptionist)
     {
          $imageUpdateName = $this->imageUpdate($request, 'avatar', $receptionist);

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

          $receptionist->update($data);
     }
     

}