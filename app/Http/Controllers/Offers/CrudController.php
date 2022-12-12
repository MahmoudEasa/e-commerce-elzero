<?php

namespace App\Http\Controllers\Offers;

use App\Http\Controllers\Controller;
use App\Http\Requests\OfferRequest;
use App\Models\Offer;

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CrudController extends Controller
{

    public function getLocalizedLangsForNavBar() {
        $getLocalized = '';
        foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
            $getLocalized .= "<li><a href='".LaravelLocalization::getLocalizedURL($localeCode, null, [], true)."'>$properties[native]</a></li>";
        };
        return $getLocalized;
    }

    public function show()
    {
        $currentLocale = LaravelLocalization::getCurrentLocale();
        $allOffers = Offer::select(
            "id",
            "offerName_$currentLocale as offerName",
            "price",
            "details_$currentLocale  as details"
        )->get();

        return Inertia::render('Offers/offers', [
            'langs' => __('messages'),
            'getLocalizedURL' => $this->getLocalizedLangsForNavBar(),
            'allOffers' => $allOffers,
        ]);
    }

    public function create()
    {
        return Inertia::render('Offers/offers', [
            'createOffer' => Route::has('offer.create'),
            'langs' => __('messages'),
            'getLocalizedURL' => $this->getLocalizedLangsForNavBar(),
        ]);
    }

    public function getOffers()
    {
        $allOffers = Offer::get();
        $selectOffers = Offer::select('id', 'offerName')->get();
        return $allOffers;
    }

    public function store(OfferRequest $request)
    {
        $validated = $request->validated();
        Offer::create($validated);
    }

    public function delete($id)
    {
        Offer::destroy($id);
    }
}