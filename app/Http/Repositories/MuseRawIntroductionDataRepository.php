<?php

namespace App\Http\Repositories;

use App\Entities\MuseRawIntroductionData;
use Illuminate\Support\Facades\DB;

/**
 * Class that contains all the database logic regarding  Interventions
 */
class MuseRawIntroductionDataRepository extends Repository
{
	protected $modelClassName = 'App\Entities\MuseRawIntroductionData';

	public function __construct()
	{

	}

}