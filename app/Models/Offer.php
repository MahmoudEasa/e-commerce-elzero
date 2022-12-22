<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\OfferScope;

class Offer extends Model
{
    use HasFactory;

    // If Table Name On Database Is Not Equel This Name
    // protected $table = 'my_Offers';
    // public $timestamps = false;

    protected $fillable = [
        'offerName_en',
        'offerName_ar',
        'price',
        'details_en',
        'details_ar',
        'photo',
        'created_at',
        'updated_at',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    ############################ Local Scopes ############################
    public function scopeInactive($query) {
        return $query->where('status', 0);
    }
    ########################################################

    ############################ Register Global Scopes ############################
    protected static function booted()
    {
        static::addGlobalScope(new OfferScope);
    }
    ########################################################

    ######################### accessors and mutators #########################
    // public function price(): Attribute
    // {
    //     return Attribute::make(
    //         // get: fn ($value) => ucfirst($value),
    //         // get: fn ($value) => "$" . $value,
    //         // set: fn ($value) => $value . "$",
    //         // set: fn ($value) => strtoupper($value),
    //     );
    // }

}
