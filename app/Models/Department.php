<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug'
    ];

    /*** Relationship start ***/
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}
