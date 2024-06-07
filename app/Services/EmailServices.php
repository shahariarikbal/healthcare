<?php

namespace App\Services;

use App\Models\Email;

class EmailServices
{
    public function getAllSendingEmailFromDatabase()
    {
        return Email::orderBy('created_at', 'desc')->get();
    }


    public function generateActionButtons($row)
    {
        
        $deleteUrl = route('email.delete', ['id' => $row->id]);
        
        $deleteBtn = '<a href="'.$deleteUrl.'" class="delete btn delete-btn float-end" onclick="return confirm(&quot;Are you sure delete this info ?&quot;)"><i class="fa-regular fa-trash-alt"></i></a>';
        return $deleteBtn;
    }
}