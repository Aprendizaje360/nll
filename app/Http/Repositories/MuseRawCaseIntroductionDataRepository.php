<?php

namespace App\Http\Repositories;

use App\Entities\MuseRawCaseIntroductionData;
use Illuminate\Support\Facades\DB;

/**
 * Class that contains all the database logic regarding  Interventions
 */
class MuseRawCaseIntroductionDataRepository extends Repository
{
	protected $modelClassName = 'App\Entities\MuseRawCaseIntroductionData';

	public function __construct()
	{

	}

}