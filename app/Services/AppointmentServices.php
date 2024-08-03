<?php

namespace App\Services;

use App\Constants\Statics;
use App\Jobs\AppointmentBookingMailJob;
use App\Models\Appointment;
use Carbon\Carbon;

class AppointmentServices
{
    public function getAppointmentDataForDatatable()
    {
       $query = Appointment::with('doctor', 'patient')->orderBy('id', 'desc');

       if(request()->filled('from_date') && request()->filled('to_date')){
         $fromDate = Carbon::parse(request()->from_date)->startOfDay();
         $toDate = Carbon::parse(request()->to_date)->endOfDay();
         $query->whereBetween('appointment_date', [$fromDate, $toDate]);
       }

       // relational field search functionality
       if($searchValue = request('search')['value']){
          $query->where(function($subQuery) use ($searchValue){
            
            $subQuery->where('problem', 'like', "%{$searchValue}%")
              ->orWhereHas('doctor', function($q) use ($searchValue){
                $q->where('first_name', 'like', "%{$searchValue}%")
                ->orWhere('last_name', 'like', "%{$searchValue}%");
              })
              ->orWhereHas('patient', function($q) use ($searchValue){
                $q->where('name', 'like', "%{$searchValue}%");
              });
              
          });
       }

       //fetch all data
       $data = $query->get();


       return $data;
    }

    public function getScheduleAppointmentDataForDatatable()
    {
       $query = Appointment::with('doctor', 'patient')
                ->whereDate('appointment_date', '!=',Carbon::today())
                ->where('is_pay', Statics::IS_NOT_PAY)
                ->orderBy('id', 'desc');

       if(request()->filled('from_date') && request()->filled('to_date')){
         $fromDate = Carbon::parse(request()->from_date)->startOfDay();
         $toDate = Carbon::parse(request()->to_date)->endOfDay();
         $query->whereBetween('appointment_date', [$fromDate, $toDate]);
       }

       // relational field search functionality
       if($searchValue = request('search')['value']){
          $query->where(function($subQuery) use ($searchValue){
            
            $subQuery->where('problem', 'like', "%{$searchValue}%")
              ->orWhereHas('doctor', function($q) use ($searchValue){
                $q->where('first_name', 'like', "%{$searchValue}%")
                ->orWhere('last_name', 'like', "%{$searchValue}%");
              })
              ->orWhereHas('patient', function($q) use ($searchValue){
                $q->where('name', 'like', "%{$searchValue}%");
              });
              
          });
       }

       //fetch all data
       $data = $query->get();


       return $data;
    }

    public function getTotalScheduleAppointmentDataForDatatable()
    {
       $data = Appointment::with('doctor', 'patient')
                ->whereDate('appointment_date', '!=',Carbon::today())
                ->where('is_pay', Statics::IS_NOT_PAY)
                ->orderBy('id', 'desc')->get()->count();

       return $data;
    }

    public function getPaymentDueAppointmentDataForDatatable()
    {
       $query = Appointment::with('doctor', 'patient')->where('is_pay', 0)->orderBy('id', 'desc');

       if(request()->filled('from_date') && request()->filled('to_date')){
         $fromDate = Carbon::parse(request()->from_date)->startOfDay();
         $toDate = Carbon::parse(request()->to_date)->endOfDay();
         $query->whereBetween('appointment_date', [$fromDate, $toDate]);
       }

       // relational field search functionality
       if($searchValue = request('search')['value']){
          $query->where(function($subQuery) use ($searchValue){
            
            $subQuery->where('problem', 'like', "%{$searchValue}%")
              ->orWhereHas('doctor', function($q) use ($searchValue){
                $q->where('first_name', 'like', "%{$searchValue}%")
                ->orWhere('last_name', 'like', "%{$searchValue}%");
              })
              ->orWhereHas('patient', function($q) use ($searchValue){
                $q->where('name', 'like', "%{$searchValue}%");
              });
              
          });
       }

       //fetch all data
       $data = $query->get();


       return $data;
    }

    public function generateActionButtons($row)
    {
          $editBtn = '';
          $deleteBtn = '';
          $billingBtn = '';
          if(auth()->guard('web')->check() || auth()->guard('receptionist')->check()){
            $editUrl = route('appointment.edit', ['id' => $row->id, 'slug' => $row->patient?->slug]);
            $editBtn = '<a href="'.$editUrl.'" class="edit edit-btn" title="Appointment edit"><i class="fa-regular fa-pen-to-square"></i></a>';
            $deleteUrl = route('appointment.delete', ['id' => $row->id,'slug' => $row->slug]);
            $deleteBtn = '<a href="'.$deleteUrl.'" class="delete delete-btn" title="appointment delete" onclick="return confirm(&quot;Are you sure delete this appointment ?&quot;)"><i class="fa-regular fa-trash-alt"></i></a>';
          }
          if(auth()->guard('account')->check()){
            $billingUrl = route('accounts.bill.collect', ['id' => $row->id, 'slug' => $row->patient?->slug]);
            $billingBtn = $row->is_pay === 1 ? '<a href="#" class="edit paid-btn" title="Paid"><i class="fa-solid fa-circle-check"></i></a>' : '<a href="'.$billingUrl.'" class="edit delete-btn" title="Billing"><i class="fa-solid fa-money-bill-transfer"></i></a>';
          }
          

          return $editBtn.' '. $billingBtn. ' '. $deleteBtn;
     }

     public function generateScheduleActionButtons($row)
    {
          $editBtn = '';
          $deleteBtn = '';
          if(!auth()->guard('account')->check()){
            $editUrl = route('appointment.edit', ['id' => $row->id, 'slug' => $row->patient?->slug]);
            $editBtn = '<a href="'.$editUrl.'" class="edit edit-btn" title="Appointment edit"><i class="fa-regular fa-pen-to-square"></i></a>';
            $deleteUrl = route('appointment.delete', ['id' => $row->id]);
            $deleteBtn = '<a href="'.$deleteUrl.'" class="delete delete-btn" title="appointment delete" onclick="return confirm(&quot;Are you sure delete this appointment ?&quot;)"><i class="fa-regular fa-trash-alt"></i></a>';
          }

          return $editBtn. ' '. $deleteBtn;
     }

     public function appointmentStore($request)
     {
        $appointment = Appointment::create([
            'doctor_id' => $request->doctor_id,
            'patient_id' => $request->patient_id,
            'appointment_date' => $request->appointment_date,
            'problem' => $request->problem,
            'status' => Statics::INACTIVE,
        ]);

        //Patient email
        $email = $appointment->patient?->email;

        dispatch(new AppointmentBookingMailJob($email, $appointment));
     }


     public function appointmentUpdate($request, $id)
     {
        $appointment = Appointment::findOrFail($id);
        $appointment->update([
            'doctor_id' => $request->doctor_id,
            'patient_id' => $request->patient_id,
            'appointment_date' => $request->appointment_date,
            'problem' => $request->problem,
        ]);
     }


     //Daily appointment query

     public function getDailyAppointmentDataForDatatable()
     {
        $query = Appointment::with('doctor', 'patient')->where('appointment_date', Carbon::today())->orderBy('created_at', 'desc');

        // daily data search functionality
       if($searchValue = request('search')['value']){
        $query->where(function($subQuery) use ($searchValue){
          
          $subQuery->where('problem', 'like', "%{$searchValue}%")
            ->orWhereHas('doctor', function($q) use ($searchValue){
              $q->where('first_name', 'like', "%{$searchValue}%")
              ->orWhere('last_name', 'like', "%{$searchValue}%");
            })
            ->orWhereHas('patient', function($q) use ($searchValue){
              $q->where('name', 'like', "%{$searchValue}%");
            });
            
        });
     }


        //fetch all data
        $data = $query->get();

        return $data;
      }

    public function generateDailyActionButtons($row)
    {
          
          $editUrl = route('appointment.daily.edit', ['id' => $row->id,'slug' => $row->slug]);

          $editBtn = '<a href="'.$editUrl.'" class="edit edit-btn" title="Appointment edit"><i class="fa-regular fa-pen-to-square"></i></a>';
          $deleteUrl = route('appointment.delete', ['id' => $row->id,'slug' => $row->slug]);
          $deleteBtn = '<a href="'.$deleteUrl.'" class="delete delete-btn" title="appointment delete" onclick="return confirm(&quot;Are you sure delete this appointment ?&quot;)"><i class="fa-regular fa-trash-alt"></i></a>';

          return $editBtn. ' '. $deleteBtn;
     }


     public function dailyAppointmentUpdate($request, $id)
     {
        $appointment = Appointment::findOrFail($id);
        $appointment->update([
            'doctor_id' => $request->doctor_id,
            'patient_id' => $request->patient_id,
            'appointment_date' => $request->appointment_date,
            'problem' => $request->problem,
        ]);
     }

     public function totalAppointmentCount()
     {
      return Appointment::select(['id'])->get()->count();
     }

     public function todayTotalAppointmentCount()
     {
      return Appointment::where('appointment_date', Carbon::today())->select(['id'])->get()->count();
     }


     //Doctor own services
  
     public function getDoctorOwnAppointmentDataForDatatable()
      {
        $doctor = auth()->guard('doctor')->user();
        $query = Appointment::with('doctor', 'patient')->whereYear('appointment_date', date('Y'))->where('doctor_id', $doctor->id)->orderBy('id', 'desc');

        if(request()->filled('from_date') && request()->filled('to_date')){
          $fromDate = Carbon::parse(request()->from_date)->startOfDay();
          $toDate = Carbon::parse(request()->to_date)->endOfDay();
          $query->whereBetween('appointment_date', [$fromDate, $toDate]);
        }

        // relational field search functionality
        if($searchValue = request('search')['value']){
            $query->where(function($subQuery) use ($searchValue){
              
              $subQuery->where('problem', 'like', "%{$searchValue}%")
                ->orWhereHas('doctor', function($q) use ($searchValue){
                  $q->where('first_name', 'like', "%{$searchValue}%")
                  ->orWhere('last_name', 'like', "%{$searchValue}%");
                })
                ->orWhereHas('patient', function($q) use ($searchValue){
                  $q->where('name', 'like', "%{$searchValue}%");
                });
                
            });
        }

        //fetch all data
        $data = $query->get();


        return $data;
      }

    public function getDoctorOwnScheduleAppointmentDataForDatatable()
    {
       $doctor = auth()->guard('doctor')->user();
       $query = Appointment::with('doctor', 'patient')->whereYear('appointment_date', date('Y'))
                ->whereDate('appointment_date', '!=', Carbon::today())
              
                ->where('doctor_id', $doctor->id)
                ->where('is_pay', Statics::IS_NOT_PAY)
                ->orderBy('id', 'desc');

       if(request()->filled('from_date') && request()->filled('to_date')){
         $fromDate = Carbon::parse(request()->from_date)->startOfDay();
         $toDate = Carbon::parse(request()->to_date)->endOfDay();
         $query->whereBetween('appointment_date', [$fromDate, $toDate]);
       }

       // relational field search functionality
       if($searchValue = request('search')['value']){
          $query->where(function($subQuery) use ($searchValue){
            
            $subQuery->where('problem', 'like', "%{$searchValue}%")
              ->orWhereHas('doctor', function($q) use ($searchValue){
                $q->where('first_name', 'like', "%{$searchValue}%")
                ->orWhere('last_name', 'like', "%{$searchValue}%");
              })
              ->orWhereHas('patient', function($q) use ($searchValue){
                $q->where('name', 'like', "%{$searchValue}%");
              });
              
          });
       }

       //fetch all data
       $data = $query->get();


       return $data;
    }

    public function getDoctorOwnDailyAppointmentDataForDatatable()
    {
       $doctor = auth()->guard('doctor')->user();
       $query = Appointment::with('doctor', 'patient')
                ->whereDate('appointment_date', Carbon::today())
                ->where('doctor_id', $doctor->id)
                ->where('is_pay', Statics::IS_PAY)
                ->orderBy('id', 'desc');

       if(request()->filled('from_date') && request()->filled('to_date')){
         $fromDate = Carbon::parse(request()->from_date)->startOfDay();
         $toDate = Carbon::parse(request()->to_date)->endOfDay();
         $query->whereBetween('appointment_date', [$fromDate, $toDate]);
       }

       // relational field search functionality
       if($searchValue = request('search')['value']){
          $query->where(function($subQuery) use ($searchValue){
            
            $subQuery->where('problem', 'like', "%{$searchValue}%")
              ->orWhereHas('doctor', function($q) use ($searchValue){
                $q->where('first_name', 'like', "%{$searchValue}%")
                ->orWhere('last_name', 'like', "%{$searchValue}%");
              })
              ->orWhereHas('patient', function($q) use ($searchValue){
                $q->where('name', 'like', "%{$searchValue}%");
              });
              
          });
       }

       //fetch all data
       $data = $query->get();


       return $data;
    }

    public function dailyDoctorAppointmentUpdate($request, $id)
     {
        $doctor = auth()->guard('doctor')->user();
        $appointment = Appointment::where('doctor_id', $doctor->id)->first();
        $appointment->update([
            'doctor_id' => $doctor->id,
            'patient_id' => $request->patient_id,
            'appointment_date' => $request->appointment_date,
            'problem' => $request->problem,
        ]);
     }
     

}