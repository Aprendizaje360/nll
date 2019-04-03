<?php

namespace App\Http\Repositories;

use App\Entities\Alternative;
use Illuminate\Support\Facades\DB;

/**
 * Class that contains all the database logic regarding  admins
 */
class AlternativeRepository extends Repository
{
	protected $modelClassName = 'App\Entities\Alternative';

	public function __construct()
	{

	}

}