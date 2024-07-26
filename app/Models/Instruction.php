<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instruction extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function prescriptions()
    {
        return $this->hasMany(Prescription::class, 'id', 'instruction_id');
    }
}
