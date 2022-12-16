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
    public function getUser() {
        return Inertia::render('User/index');
    }
    public function getAdmin() {
        return Inertia::render('Admin/index');
    }
}