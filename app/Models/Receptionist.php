<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Receptionist extends Authenticatable
{
    use HasFactory;


    protected $guard = 'receptionist';

    protected $guarded = [];

    public function sentMessages()
    {
        return $this->morphMany(Message::class, 'sender');
    }

    public function receivedMessages()
    {
        return $this->morphMany(Message::class, 'receiver');
    }

    /*** Accessor start ***/

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    /*** Accessor end ***/
}
