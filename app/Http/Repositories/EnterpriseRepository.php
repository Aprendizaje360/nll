<?php

namespace App\Http\Repositories;

use App\Entities\Enterprise;
use Illuminate\Support\Facades\DB;

/**
 * Class that contains all the database logic regarding  Enterprises
 */
class EnterpriseRepository extends Repository
{
	protected $modelClassName = 'App\Entities\Enterprise';

	public function __construct()
	{

	}

	/**
	 * Sets the role of an enterprise to "enterprise". The number 2 would be the Id of the "enterprise" role.
	 * @param enteprise $enteprise enteprise that will receive the role
	 */
	public function setEnterpriseRole(Enterprise $enterprise, $role_id)
	{
		$enterprise->roles()->attach($role_id);
	}
}