<?php

namespace App\Http\Repositories;

use App\Entities\Video;
use Illuminate\Support\Facades\DB;

/**
 * Class that contains all the database logic regarding  Videos
 */
class VideoRepository extends Repository
{
	protected $modelClassName = 'App\Entities\Video';

	public function __construct()
	{

	}

}