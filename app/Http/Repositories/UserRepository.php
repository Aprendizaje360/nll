<?php

namespace App\Http\Repositories;

use App\Entities\User;
use Illuminate\Support\Facades\DB;

/**
 * Class that contains all the database logic regarding  Users
 */
class UserRepository extends Repository
{
	protected $modelClassName = 'App\Entities\User';

	public function __construct()
	{

	}
}