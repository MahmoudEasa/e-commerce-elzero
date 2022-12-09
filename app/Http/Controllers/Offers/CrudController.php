<?php

namespace App\Http\Controllers\Offers;

use App\Models\Offer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CrudController extends Controller
{

    public function getOffers()
    {
        $allOffers = Offer::get();
        $selectOffers = Offer::select('id', 'offerName')->get();
        return $allOffers;
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'offerName' => ['required', 'max:50'],
            'price' => ['required', 'max:50'],
            'details' => ['required', 'max:50'],
        ]);
        Offer::create($validated);
    }
}
