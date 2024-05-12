<?php

namespace App\Services;

use App\Models\Doctor;
use App\Models\Message;

class MessageServices
{
     public function adminMessageToDoctor($request, $id)
     {
          $doctor = Doctor::find($id);
          $userId = auth()->guard('web')->user()->id;

          $message = new Message();
          $message->message = $request->message;

          // Set the sender ID directly
          $message->sender_id = $userId;
          $message->sender_type = get_class(auth()->guard('web')->user());

          // Associate the receiver (doctor)
          $message->receiver()->associate($doctor);
          
          $message->save();
     }

}