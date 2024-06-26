<?php

namespace App\Services;

use App\Models\Appointment;
use Carbon\Carbon;

class AppointmentServices
{
    public function getAppointmentDataForDatatable()
    {
       $query = Appointment::with('doctor', 'patient')->orderBy('created_at', 'desc');

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
          if(!auth()->guard('account')->check() && !auth()->guard('receptionist')->check()){
            $editUrl = route('appointment.edit', ['id' => $row->id]);
            $editBtn = '<a href="'.$editUrl.'" class="edit edit-btn" title="Appointment edit"><i class="fa-regular fa-pen-to-square"></i></a>';
          }
          $billingUrl = route('bill.collect', ['id' => $row->id]);
          $billingBtn = $row->is_pay === 1 ? '<a href="#" class="edit paid-btn" title="Paid"><i class="fa-solid fa-circle-check"></i></a>' : '<a href="'.$billingUrl.'" class="edit delete-btn" title="Billing"><i class="fa-solid fa-money-bill-transfer"></i></a>';

          return $editBtn.' '. $billingBtn;
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
          
          $editUrl = route('daily.appointment.edit', ['id' => $row->id,'slug' => $row->slug]);

          $editBtn = '<a href="'.$editUrl.'" class="edit edit-btn" title="Appointment edit"><i class="fa-regular fa-pen-to-square"></i></a>';

          return $editBtn;
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
     

}