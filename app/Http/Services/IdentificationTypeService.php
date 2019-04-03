<?php

namespace App\Http\Services;

//Reposstories
use App\Http\Repositories\IdentificationTypeRepository;

//Identification Types
use App\Entities\IdentificationType;

/**
 * Class that handles interaction with the IdentificationType repository and other needed logic
 */
class IdentificationTypeService
{
	protected $identificationTypeRepo;

    /**
     * Instantiates the identificationTypeRepo variable
     * @param identificationTypeRepository $identificationTypeRepo Instance of IdentificationType repository
     */
    public function __construct(IdentificationTypeRepository $identificationTypeRepo)
    {
    	$this->identificationTypeRepo = $identificationTypeRepo;
    }

    /**
     * Returns all instances of all types of IdentificationType
     * @return Collection Collection of IdentificationTypes
     */
    public function all()
    {
    	return $this->identificationTypeRepo->all();
    }
}