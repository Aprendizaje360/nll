<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

//Entities
use App\Entities\User;

//Services
use App\Http\Services\Api\UserService;



/**
 * Class that handles the interaction between the client and the services for Users
 */
class UserController extends Controller
{
    protected $userServ;
    /**
     * Instantiates the User service
     * @param UserService $userServ Instance of the User service
     */
    public function __construct(UserService $userServ)
    {
        $this->userServ = $userServ;
    }
	
    public function UpdateUser(Request $request)
    {
        try
        {
            $userData = $request['Data'];

            $user = $this->userServ->findUserByEmail($userData['email_company']);

            $this->userServ->updateUser($userData, $user);

            return Response([
                        'statusCode' => 200,
                        'message' => 'Se actualizo la data de usuario'
                    ], 200);
        }
        catch (\Exception $e)
        {
            return response([
                "status"=> "Error interno",
                "message"=> $e->getMessage() . $e->getTraceAsString()
            ], 500);
        }
    }
}
