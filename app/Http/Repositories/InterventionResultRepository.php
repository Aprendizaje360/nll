<?php

namespace App\Http\Repositories;

use App\Entities\InterventionResult;
use Illuminate\Support\Facades\DB;

/**
 * Class that contains all the database logic regarding  Interventions
 */
class InterventionResultRepository extends Repository
{
	protected $modelClassName = 'App\Entities\InterventionResult';

	public function __construct()
	{

	}

}