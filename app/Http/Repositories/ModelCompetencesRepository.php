<?php

namespace App\Http\Repositories;

use App\Entities\ModelCompetences;
use Illuminate\Support\Facades\DB;

/**
 * Class that contains all the database logic regarding  ModelCompetencess
 */
class ModelCompetencesRepository extends Repository
{
	protected $modelClassName = 'App\Entities\ModelCompetences';

	public function __construct()
	{

	}

}