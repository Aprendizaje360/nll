<?php

namespace App\Http\Repositories;

use App\Entities\MuseRawAlternativeData;
use Illuminate\Support\Facades\DB;

/**
 * Class that contains all the database logic regarding  Interventions
 */
class MuseRawAlternativeDataRepository extends Repository
{
	protected $modelClassName = 'App\Entities\MuseRawAlternativeData';

	public function __construct()
	{

	}

}