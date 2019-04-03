<?php

namespace App\Http\Repositories;

use App\Entities\Intervention;
use Illuminate\Support\Facades\DB;

/**
 * Class that contains all the database logic regarding  Interventions
 */
class InterventionRepository extends Repository
{
	protected $modelClassName = 'App\Entities\Intervention';

	public function __construct()
	{

	}

}