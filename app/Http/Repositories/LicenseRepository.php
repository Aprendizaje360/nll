<?php

namespace App\Http\Repositories;

use App\Entities\License;
use Illuminate\Support\Facades\DB;

/**
 * Class that contains all the database logic regarding  Licenses
 */
class LicenseRepository extends Repository
{
	protected $modelClassName = 'App\Entities\License';

	public function __construct()
	{

	}
}