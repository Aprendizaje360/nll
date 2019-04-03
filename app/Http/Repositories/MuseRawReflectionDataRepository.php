<?php

namespace App\Http\Repositories;

use App\Entities\MuseRawReflectionData;
use Illuminate\Support\Facades\DB;

/**
 * Class that contains all the database logic regarding  Interventions
 */
class MuseRawReflectionDataRepository extends Repository
{
	protected $modelClassName = 'App\Entities\MuseRawReflectionData';

	public function __construct()
	{

	}

}