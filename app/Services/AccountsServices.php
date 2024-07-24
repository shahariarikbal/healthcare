<?php

namespace App\Services;

use App\Models\Account;
use App\Models\Billing;
use Carbon\Carbon;
use Str;

class AccountsServices
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
    protected function imageUpdate($request, $imageFieldName, $accounts)
    {
         // Image come from user
         if ($request->hasFile($imageFieldName)) {
              $oldImage = $accounts->avatar;
              if ($oldImage && file_exists(public_path('avatar/' . $oldImage))) {
                   unlink(public_path('avatar/' . $oldImage));
              }
              $image = $request->file($imageFieldName);
              $imageName = time() . '.' . $image->extension();
              $image->move('avatar/', $imageName);
              $accounts->avatar = url('avatar/'.$imageName);

              return $imageName;
         }
         
         return url('avatar/'.$accounts->avatar);
    }

     public function accountsStore($request)
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

          $newAccounts = Account::create($data);
     }


    public function getAccountsDataForDatatable()
    {
       return Account::orderBy('created_at', 'desc')->get();
    }

    public function generateActionButtons($row)
    {
          $viewUrl = route('accounts.view', ['id' => $row->id, 'slug' => $row->slug]);
          $editUrl = route('accounts.edit', ['id' => $row->id,'slug' => $row->slug]);
          $deleteUrl = route('accounts.delete', ['id' => $row->id,'slug' => $row->slug]);

          $viewBtn = '<a href="'.$viewUrl.'" class="view view-btn" title="accounts view"><i class="fa-regular fa-eye"></i></a>';
          $editBtn = '<a href="'.$editUrl.'" class="edit edit-btn" title="accounts edit"><i class="fa-regular fa-pen-to-square"></i></a>';
          $deleteBtn = '<a href="'.$deleteUrl.'" class="delete delete-btn" title="accounts delete" onclick="return confirm(&quot;Are you sure delete this accounts ?&quot;)"><i class="fa-regular fa-trash-alt"></i></a>';

          return $editBtn . ' ' . $viewBtn . ' ' . $deleteBtn;
     }

     public function generateMessageActionButton($row)
     {
          $accountMessageUrl = route('message.accounts.show', ['id' => $row->id]);

          $accountMessageBtn = '<a href="'.$accountMessageUrl.'" class="badge-active">Message</a>';

          return $accountMessageBtn;
     }


     public function accountsUpdate($request, $accounts)
     {
          $imageUpdateName = $this->imageUpdate($request, 'avatar', $accounts);

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

          $accounts->update($data);
     }

     public function todayTotalBillCollect()
     {
          $authUserId = auth()->guard('account')->user()->id;
          $todayCollectBill = Billing::where('collected_by', $authUserId)->where('payment_date', Carbon::today())->sum('fee');
          return $todayCollectBill;
     }

     public function totalBillCollect()
     {
          $authUserId = auth()->guard('account')->user()->id;
          $totalCollectBill = Billing::where('collected_by', $authUserId)->whereYear('payment_date', date('Y'))->sum('fee');
          return $totalCollectBill;
     }
     
     protected function calculateReport($method, $field, $dataValue)
     {
          return Billing::{$method}($field, $dataValue);
     }

     public function totalBalanceReport()
     {
          $calculateReports = [
               'yearlyReport' => $this->calculateReport('whereYear', 'payment_date', date('Y'))->sum('fee'),
               'monthlyReport' => $this->calculateReport('whereYear', 'payment_date', date('Y'))
                   ->whereMonth('payment_date', date('m'))->sum('fee'),
               'todayReport' => $this->calculateReport('whereDate', 'payment_date', date('Y-m-d'))->sum('fee')
           ];

           return $calculateReports;
     }

}