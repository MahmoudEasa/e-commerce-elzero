<?php

    namespace App\Http\Controllers\Front;

    use Illuminate\Routing\Controller;

    class UserController extends Controller {
        public function __construct()
        {
            // Run Middleware On All Methods Without UserHome Method
            $this->middleware('auth')->except('UserHome');
        }

        public function ShowUserName() {
            return 'Show UserName';
        }
        public function DeleteUserName() {
            return 'Delete UserName';
        }
        public function EditUserName() {
            return 'Edit UserName';
        }
        public function UpdateUserName() {
            return 'Update UserName';
        }

        public function UserHome()
        {
            return 'User Home';
        }
    }