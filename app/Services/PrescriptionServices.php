<?php

namespace App\Services;

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
          
          $todayPrescriptions = Instruction::with('prescriptions')->where('doctor_id', $authDoctorId)->whereDate('created_at', Carbon::today())->first();
          
          return $todayPrescriptions;
     }

     public function showTotalPrescriptions()
     {
          $authDoctorId = auth()->guard('doctor')->user()->id;
          $totalPrescriptions = Prescription::with('instruction')->whereHas('instruction', fn($q) => $q->where('doctor_id', $authDoctorId))->whereYear('created_at', date('Y'))->get();
          return $totalPrescriptions;
     }
}