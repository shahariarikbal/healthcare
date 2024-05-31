<?php

namespace App\Services;

use App\Models\Appointment;
use Carbon\Carbon;

class AdminServices
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
          $viewUrl = route('appointment.view', ['id' => $row->id, 'slug' => $row->slug]);
          $editUrl = route('appointment.edit', ['id' => $row->id,'slug' => $row->slug]);

          $viewBtn = '<a href="'.$viewUrl.'" class="view view-btn" title="Appointment view"><i class="fa-regular fa-eye"></i></a>';
          $editBtn = '<a href="'.$editUrl.'" class="edit edit-btn" title="Appointment edit"><i class="fa-regular fa-pen-to-square"></i></a>';

          return $editBtn . ' ' . $viewBtn;
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
     

}