<?php

namespace App\Http\Repositories;

use App\Entities\AlternativeResult;
use Illuminate\Support\Facades\DB;

/**
 * Class that contains all the database logic regarding  admins
 */
class AlternativeResultRepository extends Repository
{
	protected $modelClassName = 'App\Entities\AlternativeResult';

	public function __construct()
	{

	}

}