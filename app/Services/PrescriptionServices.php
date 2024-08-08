<?php

namespace App\Services;

use App\Constants\Statics;
use App\Models\Appointment;
use App\Models\Instruction;
use App\Models\Prescription;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Laravel\Ui\Presets\Preset;
use Str;

class PrescriptionServices
{
     public function store($request)
     {
          DB::beginTransaction();
          $authDoctorId = auth()->guard('doctor')->user()->id;
          try{
               $instruction = Instruction::create([
                    'patient_id' => $request->patient_id,
                    'doctor_id' => $authDoctorId,
                    'gender' => $request->gender,
                    'age' => $request->age,
                    'note' => $request->instructions,
               ]);

               //Prescription insert
               foreach($request->medicine_name as $k => $data){
                    Prescription::create([
                         'instruction_id' => $instruction->id,
                         'medicine_name' => $request->medicine_name[$k],
                         'dose' => $request->dose[$k],
                         'duration' => $request->duration[$k]
                    ]);
               }

               //Appointments status update query
               $appointment = Appointment::where('patient_id', $request->patient_id)->where('appointment_date', $request->appointment_date)->first();
               if($appointment){
                    $appointment->update([
                         'status' => Statics::DONE
                    ]);
               }
               

               //commit the transaction
               DB::commit();

               return $instruction;

          }catch(ModelNotFoundException $exception){
               DB::rollBack(); //if fail any operations
               Log::error('The error is: '.$exception->getMessage());
               throw $exception;
          }catch(Exception $exception){
               DB::rollBack();
               Log::error('The error is: '.$exception->getMessage());
               throw $exception;
          }
     }

     public function showTodayPrescriptions()
     {
          $authDoctorId = auth()->guard('doctor')->user()->id;
          $query = Instruction::with('patient')->where('doctor_id', $authDoctorId)->whereDate('created_at', Carbon::today())->orderBy('id', 'desc');

          if($searchValue = request('search')['value']){
               $query->where(function($subQuery) use ($searchValue){
                 
                 $subQuery->whereHas('patient', function($q) use ($searchValue){
                     $q->where('name', 'like', "%{$searchValue}%")
                     ->orWhere('phone', 'like', "%{$searchValue}%");
                   });
                   
               });
            }

            $data = $query->get();

            return $data;
     }

     public function todayTotalPrescriptionCount()
     {
          $authDoctorId = auth()->guard('doctor')->user()->id;
          $data = Instruction::with('patient')->where('doctor_id', $authDoctorId)->whereDate('created_at', Carbon::today())->orderBy('id', 'desc')->get()->count();
          return $data;
     }

     public function showAuthDoctorPrescriptions()
     {
          $authDoctorId = auth()->guard('doctor')->user()->id;
          $query = Instruction::with('patient')->where('doctor_id', $authDoctorId)->whereYear('created_at', date('Y'))->orderBy('id', 'desc');

          if($searchValue = request('search')['value']){
               $query->where(function($subQuery) use ($searchValue){
                 
                 $subQuery->whereHas('patient', function($q) use ($searchValue){
                     $q->where('name', 'like', "%{$searchValue}%")
                     ->orWhere('phone', 'like', "%{$searchValue}%");
                   });
                   
               });
            }

            $data = $query->get();

            return $data;
     }

     public function totalPrescriptionCount()
     {
          $authDoctorId = auth()->guard('doctor')->user()->id;
          $data = Instruction::with('patient')->where('doctor_id', $authDoctorId)->whereYear('created_at', date('Y'))->orderBy('id', 'desc')->get()->count();
          return $data;
     }

     public function generateActionButtons($row)
     {
          
          $prescriptionViewUrl = route('prescription.view', ['instruction' => $row->id]);
          $prescriptionDeleteUrl = route('prescription.delete', ['instruction' => $row->id]);
          $prescriptionViewBtn = '<a href="'.$prescriptionViewUrl.'" class="view view-btn"><i class="fa-regular fa-eye"></i></a>';
          $prescriptionDeleteBtn = '<a href="'.$prescriptionDeleteUrl.'" class="delete delete-btn" onclick="return confirm(&quot;Are you sure delete this prescription ?&quot;)"><i class="fa-regular fa-trash-alt"></i></a>';
          

          return $prescriptionViewBtn.' '. $prescriptionDeleteBtn;
     }

     //For admin panel

     public function forAdminGenerateActionButtons($row)
     {
          
          $prescriptionViewUrl = route('prescription.show', ['instruction' => $row->id]);
          $prescriptionDeleteUrl = route('prescription.destroy', ['instruction' => $row->id]);
          $prescriptionViewBtn = '<a href="'.$prescriptionViewUrl.'" class="view view-btn"><i class="fa-regular fa-eye"></i></a>';
          $prescriptionDeleteBtn = '<a href="'.$prescriptionDeleteUrl.'" class="delete delete-btn" onclick="return confirm(&quot;Are you sure delete this prescription ?&quot;)"><i class="fa-regular fa-trash-alt"></i></a>';
          

          return $prescriptionViewBtn.' '. $prescriptionDeleteBtn;
     }


     public function adminShowAllPrescriptions()
     {
          $query = Instruction::with('patient')->whereYear('created_at', date('Y'))->orderBy('id', 'desc');

          if($searchValue = request('search')['value']){
               $query->where(function($subQuery) use ($searchValue){
                 
                 $subQuery->whereHas('patient', function($q) use ($searchValue){
                     $q->where('name', 'like', "%{$searchValue}%")
                     ->orWhere('phone', 'like', "%{$searchValue}%");
                   });
                   
               });
            }

            $data = $query->get();

            return $data;
     }

     public function showAllPrescriptions()
     {
          $data = Prescription::whereYear('created_at', date('Y'))->select('id')->get()->count();
          return $data;
     }

     public function showTodayAllPrescriptions()
     {
          $data = Prescription::whereYear('created_at', date('Y'))->whereDate('created_at', Carbon::today())->select('id')->get()->count();
          return $data;
     }

     public function adminShowTodayPrescriptions()
     {
          $query = Instruction::with('patient')->whereDate('created_at', Carbon::today())->orderBy('id', 'desc');

          if($searchValue = request('search')['value']){
               $query->where(function($subQuery) use ($searchValue){
                 
                 $subQuery->whereHas('patient', function($q) use ($searchValue){
                     $q->where('name', 'like', "%{$searchValue}%")
                     ->orWhere('phone', 'like', "%{$searchValue}%");
                   });
                   
               });
            }

            $data = $query->get();

            return $data;
     }
}