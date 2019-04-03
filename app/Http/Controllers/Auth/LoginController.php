<?php

namespace App\Http\Controllers\Auth;

use App\Entities\User;
use App\Http\Controllers\Controller;
use App\Http\Services\Api\InterventionService;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(InterventionService $interventionServ)
    {
        $this->middleware('guest', ['except' => 'logout']);
        $this->interventionServ = $interventionServ;
    }

    //Enabled needed for users to perform login
    protected function credentials(Request $request)
    {
        $credentials = $request->only($this->username(), 'password');
        return array_add($credentials, 'enabled', '1');
    }

    /**
     * Changed so that the username used by the login is the company email
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'email_company';
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('client.auth.login');
    }

    //Login used when the tablet is initialized
    public function apiLogin(Request $request)
    {
        try
        {
            $request = $request->all();
            $interventionId = $request['Id'];

            //Retrieve the expected attributes
            $userEmail = $request['Email'];

            $token = $request['Token'];
            //Retrieve existing user
            $user = User::where('email_company', $userEmail)
                        ->where('token', $token)
                        ->first();

            if (!$user)
            {
                return Response([
                    'statusCode' => 401,
                    'message' => 'Credenciales invalidos'
                ], 401);
            }

            if ($user->interventions()->where('int_id', $interventionId)->first()) {
                //Creates
                $token = $user->createToken('user', []);

                //Retrieve the user data
                $userData = $this->BuildUserDataJsonStructure($user);

                //Return a respones with passport token a user data
                return Response([
                        'statusCode' => 200,
                        'message' => 'Login de empresa correcto',
                        'userData' => $userData,
                        'token' => $token->accessToken,
                    ], 200);
            }

            return Response([
                    'statusCode' => 401,
                    'message' => 'Este usuario no pertenece a esta intervención.'
                ], 401);

        }
        catch(\Exception $exception)
        {
            return response([
                "status"=> "error",
                "message"=> $exception->getMessage() . $exception->getTraceAsString()
            ], 500);
        }
    }

    /**
     * Builds the structure that is adequate to Hilble's desires
     * @param User $user User to build the structure from
     */
    private function BuildUserDataJsonStructure($user)
    {
        $gender = null;

        if ($user->gender != null)
        {
            $gender = ($user->gender) ? 1 : 0;
        }

        $age = null;

        if ($user->age != null)
        {
            $age = $user->age;
        }

        $data = [
            'Nombres' => $user->name,
            'Apellidos' => $user->lastName,
            'Edad' => $age,
            'Sexo' => $gender,
            'Area' => $user->area,
            'Sector' => $user->sector,
            'Email empresa' => $user->email_company,
            'Email personal' => $user->email,
            'Cargo' => $user->work_position,
            'Anios Experiencia' => $user->year_experience,
            'Grado Academico' => $user->academic_degree,
            'Residencia' => [
                'País' => $user->country_residence,
                'Ciudad' => $user->city_residence,
            ],
            'Nacimiento' => [
                'País' => $user->country_birth,
                'Ciudad' => $user->city_birth,
            ],
            'Id' => $user->id
        ];

        return $data;
    }
}
