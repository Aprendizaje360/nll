<?php

namespace App\Http\Repositories;

use App\Entities\SequenceResult;
use Illuminate\Support\Facades\DB;

/**
 * Class that contains all the database logic regarding  Interventions
 */
class SequenceResultRepository extends Repository
{
	protected $modelClassName = 'App\Entities\SequenceResult';

	public function __construct()
	{

	}

}