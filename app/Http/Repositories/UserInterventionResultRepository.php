<?php

namespace App\Http\Repositories;

use App\Entities\UserInterventionResult;
use Illuminate\Support\Facades\DB;

/**
 * Class that contains all the database logic regarding 
 */
class UserInterventionResultRepository extends Repository
{
	protected $modelClassName = 'App\Entities\UserInterventionResult';

	public function __construct()
	{

	}

}