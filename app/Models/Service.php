<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Doctor;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'created_at',
        'updated_at',
    ];
    protected $hidden = ['created_at', 'updated_at', 'pivot'];

    public function doctors() {
        return $this->belongsToMany(Doctor::class);
    }
}