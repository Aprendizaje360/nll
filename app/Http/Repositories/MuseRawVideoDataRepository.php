<?php

namespace App\Http\Repositories;

use App\Entities\MuseRawVideoData;
use Illuminate\Support\Facades\DB;

/**
 * Class that contains all the database logic regarding  Interventions
 */
class MuseRawVideoDataRepository extends Repository
{
	protected $modelClassName = 'App\Entities\MuseRawVideoData';

	public function __construct()
	{

	}

}