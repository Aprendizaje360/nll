<?php

namespace App\Http\Controllers\EnterpriseAuth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Validator;

use App\Entities\Enterprise;

use Auth;

class RegisterController extends Controller
{
	protected $redirectPath = 'enterprise_home';

    public function showRegistrationForm()
	{
	    return view('enterprise.auth.register');
	}

	public function register(Request $request)
    {

       //Validates data
        $this->validator($request->all())->validate();

       //Create enterprise
        $enterprise = $this->create($request->all());

        //Authenticates enterprise
        $this->guard()->login($enterprise);

       //Redirects enterprises
        return redirect($this->redirectPath);
    }

    //Validates user's Input
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:enterprises',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    //Create a new seller instance after a validation.
    protected function create(array $data)
    {
        return Enterprise::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

     //Get the guard to authenticate Seller
	protected function guard()
	{
	   return Auth::guard('web_enterprise');
	}

}
