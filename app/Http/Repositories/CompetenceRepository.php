<?php

namespace App\Http\Repositories;

use App\Entities\Competence;
use Illuminate\Support\Facades\DB;

/**
 * Class that contains all the database logic regarding  ModelCompetencess
 */
class CompetenceRepository extends Repository
{
	protected $modelClassName = 'App\Entities\Competence';

	public function __construct()
	{

	}

}