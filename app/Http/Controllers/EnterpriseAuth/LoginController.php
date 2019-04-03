<?php

namespace App\Http\Controllers\EnterpriseAuth;

use App\Entities\Enterprise;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/enterprise_home';

    //Custom guard for seller
    protected function guard()
    {
      return \Auth::guard('web_enterprise');
    }

    public function showLoginForm()
    {
      return view('enterprise.auth.login');
    }

    //Enabled needed for enterprises to perform login
    protected function credentials(Request $request)
    {
        $credentials = $request->only($this->username(), 'password');
        return array_add($credentials, 'enabled', '1');
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect($this->redirectTo);
    }

    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        return $this->authenticated($request, $this->guard()->user())
                ?: redirect($this->redirectTo);
    }

    //Login used when the tablet is initialized
    public function apiLogin(Request $request)
    {
        try
        {
            //Retrieve the expected attributes
            // $enterpriseName = $request['name'];

            // $enterpriseIdNumber = $request['identificationNumber'];
            $enterprise = Auth::guard('web_enterprise')
                            ->attempt(['email' => $request['email'], 'password' => $request['password']]);

            if (!$enterprise)
            {
                return Response([
                    'statusCode' => 401,
                    'message' => 'Login de empresa incorrecto',
                ], 401);
            }
            
            $enterprise = Enterprise::where('email', $request['email'])
                                    // ->where('password', bcrypt($enterpriseIdNumber))
                                    ->first();

            $interventions = $this->BuildInterventionJsonStructure($enterprise);

            return Response([
                    'statusCode' => 200,
                    'message' => 'Login de empresa correcto',
                    'Intervenciones' => $interventions,
                    'Id' => $enterprise->id
                ], 200);
        }
        catch(\Exception $exception)
        {
            return response([
                "status"=> "error",
                "message"=> $exception->getMessage() . $exception->getTraceAsString()
            ], 500);
        }
    }

    private function BuildInterventionJsonStructure($enterprise)
    {
        $interventions = $enterprise->interventions;

        $data = [];

        foreach ($interventions as $key => $intervention)
        {
            $data[$key] =
            [
                'id' => $intervention->id,
                'nombre' => $intervention->title
            ];
        }

        return $data;
    }
}
