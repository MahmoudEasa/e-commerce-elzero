<?php

    namespace App\Http\Controllers\Front;

    use Illuminate\Routing\Controller;

    class UserController extends Controller {
        public function __construct()
        {
            // Run Middleware On All Methods Without UserHome Method
            // $this->middleware('auth')->except('HomePage');
        }

        // Login
        // public function Login()
        // {
        //     return 'Login';
        // }
        // public function LandingPage()
        // {
        //     return view('pages.landingPage');
        // }


        // Pages
        // public function HomePage()
        // {
        //     return view('pages.Home');
        // }
        // public function AboutPage()
        // {
        //     return view('pages.about', ['name' => 'Osama']);
        // }
        // public function ContactPage()
        // {
        //     return view('pages.contact');
        // }
        // public function CategoryPage($id = '')
        // {
        //     $cats = [
        //         '1' => 'Games',
        //         '2' => 'Programming',
        //         '3' => 'Books',
        //     ];

        //     $data = [];
        //     $data["id"] = $cats[$id] ?? 'This Id Is Not Found';
        //     return view('pages.category', $data);
        // }

    }