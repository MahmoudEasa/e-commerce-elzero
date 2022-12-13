<?php

namespace App\Http\Controllers\Offers;

use App\Http\Controllers\Controller;
use App\Http\Requests\OfferRequest;
use App\Traits\OfferTrait;
use App\Models\Offer;

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CrudController extends Controller
{
    use OfferTrait;
    public function showOffer()
    {
        $currentLocale = LaravelLocalization::getCurrentLocale();
        $allOffers = Offer::select(
            "id",
            "offerName_$currentLocale as offerName",
            "price",
            "photo",
            "details_$currentLocale  as details"
        )->get();

        return Inertia::render('Offers/offers', [
            'langs' => __('messages'),
            'getLocalizedURL' => $this->getLocalizedLangsForNavBar(),
            'allOffers' => $allOffers,
        ]);
    }

    public function createOffer()
    {
        return Inertia::render('Offers/offers', [
            'createOffer' => Route::has('offer.create'),
            'langs' => __('messages'),
            'getLocalizedURL' => $this->getLocalizedLangsForNavBar(),
        ]);
    }

    public function storeOffer(OfferRequest $request)
    {
        $path = 'images/offers';
        $file_name = $request -> photo ?
            $this->saveImage($request -> photo, $path) :
            "default.png";

        Offer::create([
            ...$request -> all(),
            'photo' => $file_name,
        ]);
    }

    public function editOffer($id)
    {
        $offer = Offer::find($id);

        if($offer) {
            return Inertia::render('Offers/offers', [
                'createOffer' => true,
                'langs' => __('messages'),
                'getLocalizedURL' => $this->getLocalizedLangsForNavBar(),
                'update' => true,
                'updateData' => $offer,
            ]);
        }else {
            return redirect('offers');
        }
    }

    public function updateOffer(OfferRequest $request)
    {
        $offer = Offer::find($request->id);
        $path = 'images/offers';

        $file_name =
            $request->photo != $offer->photo ?
            $this->saveImage($request->photo, $path) :
            $offer->photo;

        $offer->update([
            ...$request -> all(),
            'photo' => $file_name,
        ]);
        return redirect()->route('offers');
    }

    public function deleteOffer($id)
    {
        $offer = Offer::find($id);
        if($offer) {
            $offer->delete();
        }else {
            return redirect()->back();
        }
    }
}
