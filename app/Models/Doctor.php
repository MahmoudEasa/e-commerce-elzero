<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use App\Models\Hospital;
use App\Models\Service;

class Doctor extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'title',
        'gender',
        'hospital_id',
        'medical_id',
        'created_at',
        'updated_at',
    ];
    protected $hidden = ['created_at', 'updated_at', 'pivot'];

    public function hospital()
    {
        return $this->belongsTo(Hospital::class);
    }

    public function services() {
        return $this->belongsToMany(
            Service::class,
            'doctor_service',
            'doctor_id',
            'service_id'
        );
    }

    ######################### Begin accessors and mutators #########################
    ########### Handle Male And Female Gender get{column}attribute
    // public function getGenderAttribute($val){
    //     // return $val == 1 ? 'Male' : ($val == 2 ? 'Female' : $val);
    // }

    public function gender(): Attribute
    {
        return Attribute::make(
            // get: fn ($value) => ucfirst($value),
            get: fn ($value) => $value == 1 ? 'Male' : ($value == 2 ? 'Female' : $value),
            // set: fn ($value) => $value == 1 ? 'Male' : ($value == 2 ? 'Female' : $value),
        );
    }
}