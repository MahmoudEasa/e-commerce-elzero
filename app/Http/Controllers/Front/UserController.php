<?php

    namespace App\Http\Controllers\Front;

    use App\Events\VideoViewer;
    use App\Models\viewer;
    use App\Models\video;
    use App\Traits\OfferTrait;
    use Illuminate\Routing\Controller;
    use Inertia\Inertia;

    class UserController extends Controller {
        use OfferTrait;

        // public function __construct()
        // {
        //     // Run Middleware On All Methods Without UserHome Method
        //     // $this->middleware('auth')->except('HomePage');
        // }


        public function youtube()
        {
            $videoData = video::first();
            $viewer = viewer::get();

            event(new VideoViewer($videoData, $viewer));

            return Inertia::render('Youtube/Youtube', [
                'getLocalizedURL' => $this->getLocalizedLangsForNavBar(),
                'langs' => __('messages'),
                'videoData' => $videoData,
            ]);
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