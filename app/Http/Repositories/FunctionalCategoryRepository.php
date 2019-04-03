<?php

namespace App\Http\Repositories;

use App\Entities\FunctionalCategory;
use Illuminate\Support\Facades\DB;

/**
 * Class that contains all the database logic regarding  FunctionalCategorys
 */
class FunctionalCategoryRepository extends Repository
{
	protected $modelClassName = 'App\Entities\FunctionalCategory';

	public function __construct()
	{

	}
}