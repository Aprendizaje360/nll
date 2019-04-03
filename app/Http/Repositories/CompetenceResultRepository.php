<?php

namespace App\Http\Repositories;

use App\Entities\CompetenceResult;
use Illuminate\Support\Facades\DB;

/**
 * Class that contains all the database logic regarding  CompetenceResults
 */
class CompetenceResultRepository extends Repository
{
	protected $modelClassName = 'App\Entities\CompetenceResult';

	public function __construct()
	{

	}

}