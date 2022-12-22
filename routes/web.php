<?php

use App\Http\Controllers\Auth\CustomAuth\CustomAuthController;
use App\Http\Controllers\Auth\SocialController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Offers\CrudController;
use App\Http\Controllers\Front\UserController;
use App\Http\Controllers\Relation\RelationsController;
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

define('PAGINATION_COUNT', 3);

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

    Route::middleware(['auth'])->group(function () {
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
            Route::get('/', [CrudController::class, 'showOffers'])->name('showOffers');
            Route::get('/getOffers', [CrudController::class, 'getOffers'])->name('getOffers');
            Route::get('/showCreateOffer', [CrudController::class, 'showCreateOffer'])->name('offer.create');
            Route::post('/createOffer', [CrudController::class, 'storeOffer'])->name('createOffer');
            Route::get('/edit/{id}', [CrudController::class, 'editOffer'])->name('offer.edit');
            Route::post('/updateOffer/{id}', [CrudController::class, 'updateOffer'])->name('updateOffer');
            Route::delete('/deleteOffer/{id}', [CrudController::class, 'deleteOffer'])->name('deleteOffer');
        });

        Route::get('/youtube', [UserController::class, 'youtube'])->name('youtube');
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        ######################### Begin Authentication && Guards #########################
        ### Authentication ###
        Route::group(['middleware' => 'CheckAge'], function() {
            Route::get('adults', [CustomAuthController::class, 'adult'])->name('adults');
        });

        ### Guards => Login Admin Or User ###
        Route::get('user', [CustomAuthController::class, 'getUser'])->name('user');
    });

    Route::get('admin', [CustomAuthController::class, 'getAdmin'])->middleware('auth:admin')->name('admin');
    Route::get('adminLogin', [CustomAuthController::class, 'adminLogin'])->name('adminLogin');
    Route::post('saveAdminLogin', [CustomAuthController::class, 'saveAdminLogin'])->name('saveAdminLogin');

    ######################### End Authentication && Guards #########################

    ######################### Begin One To Many Relationship #########################
    Route::get('hospital-has-many', [RelationsController::class, 'getHospitalDoctors']);
    Route::get('hospital/{id}', [RelationsController::class, 'deleteHospital']);
    Route::get('hospital-has-doctors', [RelationsController::class, 'getHospitalHasDoctors']);
    Route::get('hospital-has-doctors-male', [RelationsController::class, 'getHospitalHasDoctorsAndMale']);
    Route::get('hospital-not-has-doctors', [RelationsController::class, 'getHospitalNotHasDoctorsAnd']);
    ######################### End One To Many Relationship #########################

    ######################### Begin Many To Many Relationship #########################
    Route::get('doctors/services', [RelationsController::class, 'getDoctorsServices']);
    Route::get('services/doctors', [RelationsController::class, 'getServicesDoctors']);
    ######################### End Many To Many Relationship #########################
});

require __DIR__.'/auth.php';
