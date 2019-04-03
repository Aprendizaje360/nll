<?php

namespace App\Http\Services;

//Repositories
use App\Http\Repositories\CompetenceTypeRepository;

//Entities

/**
 * Class that handles interaction with the admin repository and other needed logic
 */

class CompetenceTypeService
{
     protected $competenceTypeRepo;

     /**
      * Instantiates the modelCompetencesRepo variable
      * @param ModelCompetencesRepository $modelCompetencesRepo Instance of admin repository
      */
     public function __construct(competenceTypeRepository $competenceTypeRepo)
     {
        $this->competenceTypeRepo = $competenceTypeRepo;
     }

    /**
     * Returns all instances of all types of admin
     * @return Collection Collection of admins
     */
    public function all()
    {
    	return $this->competenceTypeRepo->all();
    }


}