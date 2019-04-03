<?php

namespace App\Http\Services;

//Repositories
use App\Http\Repositories\AdminTypeRepository;

//Entities
use App\Entities\AdminRole;

/**
 * Class that handles interaction with the admin repository and other needed logic
 */
class AdminTypeService
{
	protected $adminTypeRepo;

    /**
     * Instantiates the adminTypeRepo variable
     * @param adminTypeRepo $adminTypeRepo Instance of admin repository
     */
    public function __construct(AdminTypeRepository $adminTypeRepo)
    {
    	$this->adminTypeRepo = $adminTypeRepo;
    }

    /**
     * Returns all instances of all types of admin
     * @return Collection Collection of admins
     */
    public function all()
    {
    	return $this->adminTypeRepo->all();
    }

    /**
     * [store description]
     * @param  [type] $request [description]
     * @return [type]          [description]
     */
    public function store($request)
    {
  
    }

    /**
     * [update description]
     * @param  [type]    $request [description]
     * @param  AdminRole $admin   [description]
     * @return [type]             [description]
     */
    public function update($request, AdminRole $admin)
    {       
    }

    /**
     * [delete description]
     * @param  AdminRole $admin [description]
     * @return [type]           [description]
     */
    public function delete(AdminRole $admin)
    {
    }
}