<?php

use App\Http\Controllers\Auth\SocialController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Offers\CrudController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/






Route::get('/redirect/{service}', [SocialController::class, 'redirect']);
Route::get('/callback/{service}', [SocialController::class, 'callback']);


Route::group(['prefix' => LaravelLocalization::setLocale(),'middleware' =>[ 'localeSessionRedirect','localizationRedirect','localeViewPath' ]],function() {
    Route::get('/', function () {
        return Inertia::render('Welcome', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
        ]);
    });

    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', function () {
            return Inertia::render('Dashboard', [
                'getLocalizedURL' => function () {
                    $getLocalized = '';
                    foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
                        $getLocalized .= "<li><a href='".LaravelLocalization::getLocalizedURL($localeCode, null, [], true)."'>$properties[native]</a></li>";
                    };

                    return $getLocalized;
                },
                'langs' => __('messages'),

            ]);
        })->middleware(['verified'])->name('dashboard');

        Route::group(['prefix' => 'offers'], function () {
            Route::get('/', [CrudController::class, 'show'])->name('offers');
            Route::get('/create', [CrudController::class, 'create'])->name('offer.create');
            Route::get('/getOffer', [CrudController::class, 'getOffers'])->name('getOffers');
            Route::post('/createOffer', [CrudController::class, 'store'])->name('createOffer');
            Route::get('/deleteOffer/{id}', [CrudController::class, 'delete'])->name('deleteOffer');
        });

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');});

});

require __DIR__.'/auth.php';