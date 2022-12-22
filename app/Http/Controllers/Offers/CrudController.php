<?php

namespace App\Http\Controllers\Offers;

use App\Http\Controllers\Controller;
use App\Http\Requests\OfferRequest;
use App\Traits\OfferTrait;
use App\Models\Offer;
use App\Scopes\OfferScope;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CrudController extends Controller
{
    use OfferTrait;
    public function showOffers()
    {
        return Inertia::render('Offers/offers', [
            'getLocalizedURL' => $this->getLocalizedLangsForNavBar(),
        ]);
    }

    public function getOffers()
    {
        $currentLocale = LaravelLocalization::getCurrentLocale();
        // $allOffers = Offer::select(
        //     "id",
        //     "offerName_$currentLocale as offerName",
        //     "price",
        //     "photo",
        //     "details_$currentLocale  as details"
        // )->get();

        ###################### Paginate result ######################
        $allOffers = Offer::select(
            "id",
            "offerName_$currentLocale as offerName",
            "price",
            "photo",
            "details_$currentLocale  as details"
        )->paginate(PAGINATION_COUNT);

        if($allOffers) {
            return response() -> json([
                'status' => true,
                'allOffers' => $allOffers,
            ]);
        }else {
            return response() -> json([
                'status' => false,
                'message' => __('messages.cannotGetDataTryAgain'),
            ]);
        }

    }

    public function showCreateOffer()
    {
        return Inertia::render('Offers/offers', [
            'createOffer' => Route::has('offer.create'),
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
    }

    public function deleteOffer($id)
    {
        $offer = Offer::find($id);
        if($offer) {
            $deleted =  $offer->delete();
            if($deleted) {
                return response() -> json([
                    'status' => true,
                    'message' => __('messages.deleteSuccessfully'),
                ]);
            }else {
                return response() -> json([
                    'status' => false,
                    'message' => __('messages.deletedNotSuccessfulTryAgain'),
                ]);
            }
        }else {
            return response() -> json([
                'status' => false,
                'message' => __('messages.thisOfferNotFound'),
            ]);
        }
    }

    public function getAllInactiveOffers()
    {
        // where - whereNull - whereNotNull - whereIn
        // Offer::whereNotNull('status')->get();
        // Offer::whereNull('status')->get();
        // $inactiveOffer = Offer::where('status', 0)->get();
        // $inactiveOffer = Offer::inactive()->get();

        #### Global Scope
        // Offer::get();

        #### Remove Global Scope
        // Offer::withoutGlobalScope(OfferScope::class)->get();
        // Offer::withoutGlobalScopes()->get();
    }
}
