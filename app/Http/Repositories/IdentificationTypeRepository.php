<?php

namespace App\Http\Repositories;

use App\Entities\IdentificationType;
use Illuminate\Support\Facades\DB;

/**
 * Class that contains all the database logic regarding  identification types
 */
class IdentificationTypeRepository extends Repository
{
	protected $modelClassName = 'App\Entities\IdentificationType';

	public function __construct()
	{

	}
}