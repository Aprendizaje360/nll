<?php

namespace App\Http\Repositories;

use App\Entities\Sequence;
use Illuminate\Support\Facades\DB;

/**
 * Class that contains all the database logic regarding 
 */
class SequenceRepository extends Repository
{
	protected $modelClassName = 'App\Entities\Sequence';

	public function __construct()
	{

	}

}