<?php

namespace App\Http\Controllers\EnterpriseAuth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    protected $redirectTo = '/enterprise_home';

    //Show form to enterprise where they can reset password
    public function showResetForm(Request $request, $token = null)
    {
        return view('enterprise.passwords.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    public function broker()
    {
        return Password::broker('enterprises');
    }

    //returns authentication guard of seller
    protected function guard()
    {
        return Auth::guard('web_enterprise');
    }
}
