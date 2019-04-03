<?php

namespace App\Http\Repositories;

use App\Entities\CompetenceType;
use Illuminate\Support\Facades\DB;

/**
 * Class that contains all the database logic regarding  CompetenceTypes
 */
class CompetenceTypeRepository extends Repository
{
	protected $modelClassName = 'App\Entities\CompetenceType';

	public function __construct()
	{

	}

}