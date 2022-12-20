<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Hospital;
use App\Models\Service;

class Doctor extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'title',
        'hospital_id',
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
}