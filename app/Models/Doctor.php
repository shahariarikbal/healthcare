<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Doctor extends Authenticatable
{
    use HasFactory;

    protected $guard = 'doctor';

    protected $guarded = [];

    /*** Relationship start ***/
    public function department()
    {
        return $this->hasOne(Department::class, 'id', 'department_id');
    }

    /*** Accessor start ***/

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    /*** Accessor end ***/
}
