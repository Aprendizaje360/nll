<?php

namespace App\Http\Repositories;

use App\Entities\MuseRawWelcomeData;
use Illuminate\Support\Facades\DB;

/**
 * Class that contains all the database logic regarding  MuseRawWelcomeDatas
 */
class MuseRawWelcomeDataRepository extends Repository
{
	protected $modelClassName = 'App\Entities\MuseRawWelcomeData';

	public function __construct()
	{

	}
}