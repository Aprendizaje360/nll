<?php

namespace App\Http\Repositories;

use Illuminate\Support\Facades\DB;

/**
 * Class that contains all the database logic regarding  admins
 */
class CompetenceLevelRepository extends Repository
{
	protected $modelClassName = 'App\Entities\CompetenceLevel';

	public function __construct()
	{

	}
}