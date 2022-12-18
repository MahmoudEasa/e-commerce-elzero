<?php

namespace App\Http\Controllers\Auth\CustomAuth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    public function adminLogin()
    {
        return Inertia::render('Admin/Login');
    }

    public function saveAdminLogin(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:6'],
        ]);

        if(Auth::guard('admin')->attempt([
            'email' => $request->email,
            'password' => $request->password
        ])){
            return redirect()->intended('/admin');
        }

        return back()->withInput($request->only('email'));
    }
}