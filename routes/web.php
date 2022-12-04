<?php

use App\Http\Controllers\Front\NewsController;
use App\Http\Controllers\Front\UserController;
use Illuminate\Support\Facades\Route;

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

// Login
Route::get('login', function () {
    return 'Login';
})->name('login');


Route::group(['prefix' => '/'], function () {
    Route::get('/', function () {
        return view('pages.Home');
    })->name('home');

    Route::get('/about-me', function () {
        return view('pages.about', ['name' => 'Osama']);
    })->name('about');

    Route::view('/contact-me', 'pages.contact', [
        'name' => 'Mahmoud'
    ])->name('contact');

    Route::get('/category/{id?}', function ($id = '') {
        $cats = [
            '1' => 'Games',
            '2' => 'Programming',
            '3' => 'Books',
        ];

        return view('pages.category', [
            'id' => $cats[$id] ?? 'This Id Is Not Found'
        ]);
    })->name('category');
});


// Controller
Route::group(['prefix' => 'users'], function () {
    Route::get('/', [UserController::class, 'UserHome']);
    Route::get('show', [UserController::class, 'ShowUserName']);
    Route::delete('delete', [UserController::class, 'DeleteUserName']);
    Route::get('edit', [UserController::class, 'EditUserName']);
    Route::put('update', [UserController::class, 'UpdateUserName']);
});

// Resource
Route::resource('news', NewsController::class);