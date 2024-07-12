<?php

namespace App\Services;

use App\Jobs\GeneratePdfJob;
use App\Models\Account;
use App\Models\Appointment;
use App\Models\Billing;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Str;

class BillingServices
{
    public function invoiceNumber()
      {
          $billingLastId = Billing::orderBy('id', 'desc')->first();
          if (! $billingLastId) {
              return'HC0001';
          } else {
              $string = preg_replace("/[^0-9\.]/", '', $billingLastId->id);
              return 'HC' . sprintf('%04d', $string+1);
          }
      }
    public function billStore($request, $id)
    {
          $appointment = Appointment::with('doctor', 'patient')->findOrFail($id);
          $storeBill = Billing::create([
               'invoiceId' => $this->invoiceNumber(),
               'doctor_id' => $request->doctor_id,
               'fee' => $request->fee,
               'patient_id' => $request->patient_id,
               'appointment_date' => $request->appointment_date,
               'payment_type' => 'Cash',
               'payment_date' => $request->payment_date,
               'collected_by' => auth()->guard('web')->check() ? 0 : (auth()->guard('account')->check() ? auth()->guard('account')->user()->id : 0),
          ]);

          $appointment->update(['is_pay' => true, 'status' => 5]);

          //PDF dispatch
          GeneratePdfJob::dispatch($appointment, $storeBill);

          return $storeBill;
    }


    //********** Invoices method ***********//
    public function getAllInvoicesFromDatabase()
    {
        $query = Billing::with(['doctor', 'patient'])->orderBy('created_at', 'desc');

        if(request()->filled('from_date') && request()->filled('to_date')){
            $fromDate = Carbon::parse(request()->from_date)->startOfDay();
            $toDate = Carbon::parse(request()->to_date)->endOfDay();
            $query->whereBetween('payment_date', [$fromDate, $toDate]);
          }
   
          // relational field search functionality
          if($searchValue = request('search')['value']){
             $query->where(function($subQuery) use ($searchValue){
               
               $subQuery->orWhereHas('doctor', function($q) use ($searchValue){
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
          $invoiceDeleteBtn = '';
          $invoiceDownloadUrl = route('accounts.invoice.download', ['id' => $row->id]);
          $invoiceDownloadBtn = '<a href="'.$invoiceDownloadUrl.'" class="btn btn-primary btn-sm" title="Invoice download">Invoice</a>';
          if(auth()->guard('web')->check()){
            $invoiceDelete = route('accounts.invoice.delete', ['id' => $row->id]);
            $invoiceDeleteBtn = '<a href="'.$invoiceDelete.'" class="btn btn-danger btn-sm" onclick="return confirm(&quot;Are you sure permanently delete this invoice ?&quot;)" title="Invoice delete">Delete</a>';
          }

          return $invoiceDownloadBtn.' '. $invoiceDeleteBtn;
    }


     //******** Payment report ********//
     public function getAllPaymentReportFromDatabase()
      {
        $query = Billing::with(['doctor', 'patient'])->orderBy('created_at', 'desc');

        if(request()->filled('from_date') && request()->filled('to_date')){
            $fromDate = Carbon::parse(request()->from_date)->startOfDay();
            $toDate = Carbon::parse(request()->to_date)->endOfDay();
            $query->whereBetween('payment_date', [$fromDate, $toDate]);
          }

          if (request()->filled('payment_type')) {
            $query->where('payment_type', request()->payment_type);
          }
   
          // relational field search functionality
          if($searchValue = request('search')['value']){
             $query->where(function($subQuery) use ($searchValue){
               
               $subQuery->orWhereHas('doctor', function($q) use ($searchValue){
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
}