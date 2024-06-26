<?php

namespace App\Services;

use App\Models\Account;
use App\Models\Appointment;
use App\Models\Billing;
use Str;

class BillingServices
{
    public function billStore($request, $id)
    {
          $appointment = Appointment::with('doctor', 'patient')->findOrFail($id);
          $storeBill = Billing::create([
               'doctor_id' => $request->doctor_id,
               'fee' => $request->fee,
               'patient_id' => $request->patient_id,
               'appointment_date' => $request->appointment_date,
               'payment_type' => $request->payment_type,
               'payment_date' => $request->payment_date,
               'collected_by' => auth()->guard('web')->check() ? 0 : (auth()->guard('account')->check() ? auth()->guard('account')->user()->id : 0),
          ]);

          $appointment->update(['is_pay' => true, 'status' => 5]);

          return $storeBill;
    }
}