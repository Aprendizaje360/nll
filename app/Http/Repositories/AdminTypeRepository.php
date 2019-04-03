<?php

namespace App\Http\Repositories;

use Illuminate\Support\Facades\DB;

/**
 * Class that contains all the database logic regarding  admins
 */
class AdminTypeRepository extends Repository
{
	protected $modelClassName = 'App\Entities\AdminRole';

	public function __construct()
	{

	}
}