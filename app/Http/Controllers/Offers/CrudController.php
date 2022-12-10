<?php

namespace App\Http\Controllers\Offers;

use App\Models\Offer;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CrudController extends Controller
{

    public function show()
    {
        return Inertia::render('Offers/offers');
    }

    public function create()
    {
        return Inertia::render('Offers/offers', [
            'createOffer' => Route::has('offer.create'),
        ]);
    }

    public function getOffers()
    {
        $allOffers = Offer::get();
        $selectOffers = Offer::select('id', 'offerName')->get();
        return $allOffers;
    }

    public function store(Request $request)
    {
        $roles = $this -> getRoles();
        $messages = $this -> getMessages();
        $validated = $request->validate($roles, $messages);
        Offer::create($validated);
    }

    protected function getMessages() {
        return [
            'offerName.required' => 'أسم العرض مطلوب',
            'offerName.unique' => 'أسم العرض موجود',
            'price.required' => 'السعر مطلوب',
            'price.numeric' => 'السعر يجب أن يكون أرقام',
            'details.required' => 'التفاصيل مطلوبة',
        ];
    }
    protected function getRoles() {
        return [
            'offerName' => ['bail', 'required', 'unique:offers', 'max:100'],
            'price' => ['required', 'numeric'],
            'details' => ['required'],
        ];
    }
}