<?php

namespace App\Services;

use App\Models\Account;
use App\Models\Doctor;
use App\Models\Message;
use App\Models\Receptionist;

class MessageServices
{
     public function adminMessageToDoctor($request, $id)
     {
          $doctor = Doctor::find($id);
          $userId = auth()->guard('web')->user()->id;

          $message = new Message();
          $message->message = $request->message;

          // sender ID set directly
          $message->sender_id = $userId;
          $message->sender_type = get_class(auth()->guard('web')->user());

          // receiver ID associate (doctor)
          $message->receiver()->associate($doctor);
          
          $message->save();
     }


     public function adminMessageToReceptionist($request, $id)
     {
          $reception = Receptionist::findOrFail($id);
          $userId = auth()->guard('web')->user()->id;

          $message = new Message();
          $message->message = $request->message;

          // sender ID set directly
          $message->sender_id = $userId;
          $message->sender_type = get_class(auth()->guard('web')->user());

          // receiver ID associate (receptionist)
          $message->receiver()->associate($reception);
          
          $message->save();
     }

     public function adminMessageToAccounts($request, $id)
     {
          $account = Account::findOrFail($id);
          $userId = auth()->guard('web')->user()->id;

          $message = new Message();
          $message->message = $request->message;

          // sender ID set directly
          $message->sender_id = $userId;
          $message->sender_type = get_class(auth()->guard('web')->user());

          // receiver ID associate (account)
          $message->receiver()->associate($account);
          
          $message->save();
     }

}