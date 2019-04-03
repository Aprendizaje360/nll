<?php

namespace App\Http\Services;

//Repositories
use App\Http\Repositories\AdminRepository;

//Entities
use App\Entities\Admin;

//Jobs
use App\Jobs\SendAdminInfoEmail;

/**
 * Class that handles interaction with the admin repository and other needed logic
 */
class AdminService
{
	protected $adminRepo;

    /**
     * Instantiates the adminRepo variable
     * @param AdminRepository $adminRepo Instance of admin repository
     */
    public function __construct(AdminRepository $adminRepo)
    {
    	$this->adminRepo = $adminRepo;
    }

    /**
     * Returns all instances of all types of admin
     * @return Collection Collection of admins
     */
    public function all()
    {
    	return $this->adminRepo->all();
    }

    /**
     * Stores an admin, sets role of admin and sends an email with the admin info 
     * @param  Request $request Attributes for the new admin
     * @return null             Null
     */
    public function store($request)
    {
        $passwordBeforeHash = $request['password'];
        $request->merge(['password' => bcrypt($request['password'])]);
        $newAdmin = $this->adminRepo->create($request->all()); 
        $this->adminRepo->setAdminRole($newAdmin, $request['admin_role']);
        if ($request['send_email'])
        {
            dispatch(new SendAdminInfoEmail($newAdmin, $passwordBeforeHash)); 
        }
    }

    /**
     * Updates an admin
     * @param  Request $request Attributes to be used in the update process
     * @param  Admin  $admin   Admin to be updated
     * @return Admin          Updated admin
     */
    public function update($request, Admin $admin)
    {       
        if ($request['password'] == null) {
            $request->offsetUnset('password');
            $request->offsetUnset('password_confirmation');
        }
        else {
            $request->merge(['password' => bcrypt($request['password'])]);
        }
        return $this->adminRepo->update($request->all(), $admin);
    }

    /**
     * Deletes an Admin
     * @param  Admin  $admin Admin to be deleted
     * @return int        Row of the deleted admin
     */
    public function delete(Admin $admin)
    {
        return $this->adminRepo->delete($admin->id); 
    }
}