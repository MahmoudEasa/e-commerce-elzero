<?php

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

Route::get('about-me', function () {
    return view('pages.about', ['name' => 'Osama']);
})->name('about');

Route::get('/', function () {
    return view('pages.Home');
})->name('home');

Route::view('contact-me', 'pages.contact', [
    'name' => 'Mahmoud'
])->name('contact');

Route::get('category/{id}', function ($id) {
    $cats = [
        '1' => 'Games',
        '2' => 'Programming',
        '3' => 'Books',
    ];

    return view('pages.category', [
        'id' => $cats[$id] ?? 'This Id Is Not Found'
    ]);
})->name('category');