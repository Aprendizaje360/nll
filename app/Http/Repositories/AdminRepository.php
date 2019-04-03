<?php

namespace App\Http\Repositories;

use App\Entities\Admin;
use Illuminate\Support\Facades\DB;

/**
 * Class that contains all the database logic regarding  admins
 */
class AdminRepository extends Repository
{
	protected $modelClassName = 'App\Entities\Admin';

	public function __construct()
	{

	}

	/**
	 * Sets the role of an admin to "Admin". The number 2 would be the Id of the "Admin" role.
	 * @param Admin $admin Admin that will receive the role
	 */
	public function setAdminRole(Admin $admin, $role_id)
	{
		$admin->roles()->attach($role_id);
	}
}