<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//Services
use App\Http\Services\AdminService;
use App\Http\Services\AdminTypeService;

//Entities
use App\Entities\Admin;

//Requests
use App\Http\Requests\Admin\StoreAdmin;
use App\Http\Requests\Admin\UpdateAdmin;
use App\Http\Requests\Admin\DeleteAdmin;

/**
 * Class that handles the interaction between the client and the services for Admins
 */
class AdminUserController extends Controller
{
    protected $adminServ;
    protected $adminTypeServ;
    /**
     * It requires an admin service and admin type service instance
     * @param AdminService $adminServ Instance of the admin service
     * @param AdminTypeService $adminTypeServ Instance of the admin type service
     */
    public function __construct(AdminService $adminServ, AdminTypeService $adminTypeServ)
    {
        $this->adminServ = $adminServ;
        $this->adminTypeServ = $adminTypeServ;
    }
	/**
	 * Lists all admin users and shows interfaces for 
	 * CRD operations
	 * @return void
	 */
    public function index()
    {
        $admins = $this->adminServ->all();
        $adminRoles = $this->adminTypeServ->all();
        return view('admin.administrators.dashboard', compact('admins', 'adminRoles'));
    }

    public function showPanel(Admin $admin)
    {
        return view('admin.administrators.profile', compact('admin'));
    }

    /**
     * Stores a new admin user
     * @param  Request $request 
     * @return void
     */
    public function store(StoreAdmin $request)
    {
        $this->adminServ->store($request);

        return back();
    }

    /**
     * view to edit an admin user
     * @param  Request $request 
     * @param  Admin   $admin  
     * @return void
     */
    public function edit(Admin $admin)
    {
        $admins = $this->adminServ->all();
        $currentAdmin = $admin;

        return view('admin.administrators.edit', compact('admins', 'currentAdmin'));
    }

    /**
     * Update an Admin
     * @param  Request $request 
     * @param  Admin   $admin   
     * @return void
     */
    public function update(UpdateAdmin $request, Admin $admin)
    {
        $this->adminServ->update($request, $admin);
        $request->session()->flash('success', 'Administrador modificado');

        return back();
    }

    /**
     * Updates the profile
     * @param  UpdateAdmin $request [description]
     * @param  Admin       $admin   [description]
     * @return [type]               [description]
     */
    public function profileUpdate(UpdateAdmin $request, Admin $admin)
    {
        $this->adminServ->update($request, $admin);
        $request->session()->flash('success', 'Administrador modificado');

        return back();
    }

    /**
     * Delete an Admin user and flashes a message of success
     * @param  Request $request
     * @param  Admin   $admin
     * @return void
     */
    public function delete(DeleteAdmin $request, Admin $admin)
    {
        $this->adminServ->delete($admin);
        $request->session()->flash('success', 'Administrador eliminado');

        return back();
    }
}
