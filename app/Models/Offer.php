<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    // If Table Name On Database Is Not Equel This Name
    // protected $table = 'my_Offers';
    // public $timestamps = false;

    protected $fillable = [
        'offerName',
        'price',
        'details',
        'created_at',
        'updated_at',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

}
