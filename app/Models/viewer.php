<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class viewer extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['user','video'];


    // #################### Begin relation ####################
    // public function video()
    // {
    //     return $this->hasMany('');
    // }
    // ####################  End relation  ####################

}