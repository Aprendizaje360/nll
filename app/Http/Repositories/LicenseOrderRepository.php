<?php

namespace App\Http\Repositories;

use App\Entities\LicenseOrder;
use Illuminate\Support\Facades\DB;

/**
 * Class that contains all the database logic regarding  LicenseOrrers
 */
class LicenseOrderRepository extends Repository
{
	protected $modelClassName = 'App\Entities\LicenseOrder';

	public function __construct()
	{

	}
}