<?php

namespace App\Http\Controllers\AdminAuth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//Class needed for login and Logout logic
use Illuminate\Foundation\Auth\AuthenticatesUsers;

//Auth facade
use Auth;

class LoginController extends Controller
{
    //Where to redirect seller after login.
    protected $redirectTo = '/admin_home';

    //Trait
    use AuthenticatesUsers;

    //Custom guard for seller
    protected function guard()
    {
      return Auth::guard('web_admin');
    }

    //Shows seller login form
	public function showLoginForm()
	{
	  return view('admin.auth.login');
	}
}