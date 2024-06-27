<?php

namespace App\Services;

use App\Models\Expanse;
use Carbon\Carbon;

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

     public function expanseUpdate($request, $expanse)
     {
          $imageUpdate = $this->imageUpdate($request, 'image', $expanse);

          $expanse->update([
               'expanse_date' => $request->expanse_date,
               'amount' => $request->amount,
               'purpose' => $request->purpose,
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

     protected function imageUpdate($request, $imageFieldName, $expanse)
     {
          // if user image is provided
          if ($request->hasFile($imageFieldName)) {
               $oldImage = $expanse->image;
               if ($oldImage && file_exists(public_path('expanse/' . $oldImage))) {
                    unlink(public_path('expanse/' . $oldImage));
               }
               $image = $request->file($imageFieldName);
               $imageName = time() . '.' . $image->extension();
               $image->move('expanse/', $imageName);
               $expanse->image = url('expanse/'.$imageName);

               return $imageName;
          }
          
          return url('expanse/'.$expanse->image);
     }

     public function getAllDataFromDatabase()
     {
          $query = Expanse::orderBy('created_at', 'desc');

          if(request()->filled('from_date') && request()->filled('to_date')){
               $fromDate = Carbon::parse(request()->from_date)->startOfDay();
               $toDate = Carbon::parse(request()->to_date)->endOfDay();
               $query->whereBetween('expanse_date', [$fromDate, $toDate]);
          }

          $data = $query->get();
          return $data;
     }

     public function getActionButton($row)
     {
          $editUrl = route('accounts.expanse.edit', ['id' => $row->id]);
          $deleteUrl = route('accounts.expanse.delete', ['id' => $row->id]);

          $editBtn = '<a href="'.$editUrl.'" class="edit edit-btn"><i class="fa-regular fa-pen-to-square"></i></a>';
          $deleteBtn = '<a href="'.$deleteUrl.'" class="delete delete-btn" onclick="return confirm(&quot;Are you sure delete this expnase ?&quot;)"><i class="fa-regular fa-trash-alt"></i></a>';

          return $editBtn.' '.$deleteBtn;
     }
}