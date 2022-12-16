<?php

namespace App\Http\Controllers\Auth\CustomAuth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CustomAuthController extends Controller
{
    public function adult() {
        return Inertia::render('CustomAuth/index');
    }
}