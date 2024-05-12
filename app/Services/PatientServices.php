<?php

namespace App\Services;

use App\Models\Patient;

class PatientServices
{
     public function patientStore($request)
     {

          $data = [
               'name' => $request->name,
               'email' => $request->email,
               'phone' => $request->phone,
               'address' => $request->address,
          ];

          $newPatient = Patient::create($data);
     }


    public function getPatientDataForDatatable()
    {
       return Patient::orderBy('created_at', 'desc')->get();
    }

    public function generateActionButtons($row)
    {
          $viewUrl = route('patient.prescription', ['id' => $row->id]);
          $editUrl = route('patient.edit', ['id' => $row->id]);
          $deleteUrl = route('patient.delete', ['id' => $row->id]);

          $viewBtn = '<a href="'.$viewUrl.'" class="view view-btn" title="Prescription view"><i class="fa-regular fa-eye"></i></a>';
          $editBtn = '<a href="'.$editUrl.'" class="edit edit-btn" title="Patient edit"><i class="fa-regular fa-pen-to-square"></i></a>';
          $deleteBtn = '<a href="'.$deleteUrl.'" class="delete delete-btn" title="Patient delete" onclick="return confirm(&quot;Are you sure delete this doctor ?&quot;)"><i class="fa-regular fa-trash-alt"></i></a>';

          

          return $editBtn . ' ' . $viewBtn . ' ' . $deleteBtn;
     }

     public function generateMessageActionButton($row)
    {
          $doctorMessageUrl = route('patient.message', ['id' => $row->id]);

          $doctorMessageBtn = '<a href="'.$doctorMessageUrl.'" class="badge-active">Message</a>';

          return $doctorMessageBtn;
     }


     public function patientUpdate($request, $patient)
     {
          $data = [
               'name' => $request->name,
               'email' => $request->email,
               'phone' => $request->phone,
               'address' => $request->address,
          ];

          $patient->update($data);
     }
     

}