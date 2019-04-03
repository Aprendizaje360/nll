<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//Services
use App\Http\Services\AdminService;
use App\Http\Services\AdminTypeService;

//Entities
use App\Entities\CompetenceLevel;

//Requests

/**
 * Class that handles the interaction between the client and the services for Admins
 */
class CompetenceLevelController extends Controller
{
    /**
     * It requires an admin service and admin type service instance
     * @param AdminService $adminServ Instance of the admin service
     * @param AdminTypeService $adminTypeServ Instance of the admin type service
     */
    public function __construct()
    {
    }

}
