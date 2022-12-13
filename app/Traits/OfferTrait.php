<?php

namespace App\Traits;

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Trait OfferTrait
{
    function saveImage($photo, $folder)
    {
        $file_extension = $photo -> getClientOriginalExtension();
        $file_name = time() .'.'. $file_extension;
        $path = $folder;
        $photo->move($path, $file_name);
        return $file_name;
    }

    function getLocalizedLangsForNavBar() {
        $getLocalized = '';
        foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
            $getLocalized .= "<li><a href='".LaravelLocalization::getLocalizedURL($localeCode, null, [], true)."'>$properties[native]</a></li>";
        };
        return $getLocalized;
    }
}