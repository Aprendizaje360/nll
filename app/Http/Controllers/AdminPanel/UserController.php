<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Services\UserService;
use App\Http\Services\UserTypeService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Entities\User;
use App\Http\Requests\User\StoreUser;
use App\Http\Requests\User\UpdateUser;
use App\Http\Requests\User\DeleteUser;

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
	/**
	 * Lists all Users and shows interfaces for 
	 * CRD operations
	 * @return void
	 */
    public function index()
    {
        $users = $this->userServ->all();
        return view('admin.users.dashboard', compact('users'));
    }

    /**
     * Stores a new User user
     * @param  Request $request 
     * @return void
     */
    public function store(StoreUser $request)
    {
        $this->userServ->store($request);

        return back();
    }

    /**
     * view to edit an User
     * @param  Request $request 
     * @param  User   $User  
     * @return void
     */
    public function edit(Request $request, User $user )
    {
        return view('admin.users.edit', compact( 'user' ));
    }

    /**
     * Update an User
     * @param  Request $request 
     * @param  User   $User   
     * @return void
     */
    public function update(UpdateUser $request, User $user)
    {
        $this->userServ->update($request, $user);
        $request->session()->flash('success', 'Usuario modificado');

        return back();
    }

    /**
     * Delete an User user and flashes a message of success
     * @param  Request $request
     * @param  User   $User
     * @return void
     */
    public function delete(DeleteUser $request, User $User)
    {
        $this->userServ->delete($User);
        $request->session()->flash('success', 'Usuario eliminado');

        return back();
    }
}
