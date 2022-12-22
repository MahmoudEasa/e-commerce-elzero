<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Medical;
use App\Models\Doctor;

class Patient extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['name', 'age'];

    public function doctor()
    {
        // return $this->hasOneThrough(Doctor::class, Medical::class, 'patient_id', 'medical_id');
        return $this->hasManyThrough(Doctor::class, Medical::class, 'patient_id', 'medical_id');
    }
}
