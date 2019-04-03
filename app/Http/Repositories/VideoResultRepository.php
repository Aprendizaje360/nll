<?php

namespace App\Http\Repositories;

use App\Entities\VideoResult;
use Illuminate\Support\Facades\DB;

/**
 * Class that contains all the database logic regarding  admins
 */
class VideoResultRepository extends Repository
{
	protected $modelClassName = 'App\Entities\VideoResult';

	public function __construct()
	{

	}

}