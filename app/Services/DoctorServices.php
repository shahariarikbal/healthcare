<?php

namespace App\Services;

use App\Constants\Statics;
use App\Constants\Status;
use App\Models\Appointment;
use App\Models\Doctor;
use Carbon\Carbon;
use Illuminate\Support\Str;

class DoctorServices
{
     public function doctorStore($request)
     {
          $imageName = $this->imageStore($request, 'avatar');

          $data = [
               'department_id' => $request->department_id,
               'first_name' => $request->first_name,
               'last_name' => $request->last_name,
               'slug' => Str::slug($request->first_name . ' ' . $request->last_name),
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
          $editBtn = '';
          $viewBtn = '';
          $deleteBtn = '';
          
          if(auth()->guard('account')->check() || auth()->guard('receptionist')->check() || auth()->guard('web')->check()){
               $viewUrl = route('doctor.view', ['id' => $row->id,'slug' => $row->slug]);
          }
          if(auth()->guard('web')->check()){
               $editUrl = route('doctor.edit', ['id' => $row->id,'slug' => $row->slug]);
               $deleteUrl = route('doctor.delete', ['id' => $row->id,'slug' => $row->slug]);
          }
          if(auth()->guard('account')->check() || auth()->guard('receptionist')->check() || auth()->guard('web')->check()){
               $viewBtn = '<a href="'.$viewUrl.'" class="view view-btn"><i class="fa-regular fa-eye"></i></a>';
          }

          if(auth()->guard('web')->check()){
               $editBtn = '<a href="'.$editUrl.'" class="edit edit-btn"><i class="fa-regular fa-pen-to-square"></i></a>';
               $deleteBtn = '<a href="'.$deleteUrl.'" class="delete delete-btn" onclick="return confirm(&quot;Are you sure delete this doctor ?&quot;)"><i class="fa-regular fa-trash-alt"></i></a>';
          }

          

          return $editBtn . ' ' . $viewBtn . ' ' . $deleteBtn;
     }

     public function generateMessageActionButton($row)
    {
          $doctorMessageUrl = route('message.doctor.show', ['id' => $row->id]);

          $doctorMessageBtn = '<a href="'.$doctorMessageUrl.'" class="badge-active">Message</a>';

          return $doctorMessageBtn;
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
          // if user image is provided
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
          
          return url('avatar/'.$doctor->avatar);
     }


     public function totalDoctorCount()
     {
      return Doctor::select(['id'])->get()->count();
     }

     public function appointmentCount()
     {
          $doctorId = auth()->guard('doctor')->user()->id ?? '';
          $data = [
               'totalAppointment' => Appointment::whereYear('appointment_date', date('Y'))->where('doctor_id', $doctorId)->select('id')->get()->count(),
               'todayTotalAppointment' => Appointment::whereDate('appointment_date', Carbon::today())->where('doctor_id', $doctorId)->select('id')->get()->count(),
               'scheduleTotalAppointment' => Appointment::whereYear('appointment_date', date('Y'))->whereDate('appointment_date', '!=', Carbon::today())
                                             ->where('is_pay', Statics::IS_NOT_PAY)
                                             ->where('doctor_id', $doctorId)
                                             ->select('id')
                                             ->get()
                                             ->count(),
          ];

          return $data;
     }

     public function profileUpdate($request)
     {
          $doctor = auth()->guard('doctor')->user();
          $imageUpdateName = $this->imageUpdate($request, 'avatar', $doctor);

          $data = [
               'first_name' => $request->first_name,
               'last_name' => $request->last_name,
               'email' => $request->email,
               'phone' => $request->phone,
               'qualification' => $request->qualification,
          ];

          $doctor->update($data);
     }

     

}