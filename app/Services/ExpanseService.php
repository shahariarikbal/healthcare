<?php

namespace App\Services;

use App\Models\Expanse;

class ExpanseService
{
     public function expanseStore($request)
     {
          $imageName = $this->imageStore($request, 'image');
          Expanse::create([
               'expanse_date' => $request->expanse_date,
               'amount' => $request->amount,
               'purpose' => $request->purpose,
               'image' => $imageName ? url('expanse/'.$imageName) : null,
          ]);
     }

     protected function imageStore($request, $imageFieldName)
     {
          if($request->hasFile($imageFieldName)){
               $image = $request->file($imageFieldName);
               $imageName = time().'.'.$image->extension();
               $image->move('expanse/', $imageName);
       
               return $imageName;
          }
        
     }
}