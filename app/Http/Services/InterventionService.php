<?php

namespace App\Http\Services;

//Repositories
use App\Http\Repositories\InterventionRepository;

//Entities
use App\Entities\Intervention;

/**
 * Class that handles interaction with the Intervention repository and other needed logic
 */
class InterventionService
{
	protected $interventionRepo;

    /**
     * Instantiates the InterventionRepo variable
     * @param InterventionRepository $interventionRepo Instance of Intervention repository
     */
    public function __construct(InterventionRepository $interventionRepo)
    {
    	$this->InterventionRepo = $interventionRepo;
    }

    /**
     * Returns all instances of all types of Intervention
     * @return Collection Collection of Interventions
     */
    public function all()
    {
    	return $this->InterventionRepo->all();
    }

    /**
     * Stores an Intervention, sets role of Intervention and sends an email with the Intervention info 
     * @param  Request $request Attributes for the new Intervention
     * @return null             Null
     */
    public function store($request)
    {
        $newIntervention = $this->InterventionRepo->create($request->all()); 
    }

    /**
     * Updates an Intervention
     * @param  Request $request Attributes to be used in the update process
     * @param  Intervention  $intervention   Intervention to be updated
     * @return Intervention          Updated Intervention
     */
    public function update($request, Intervention $intervention)
    {       
        return $this->InterventionRepo->update($request->all(), $intervention);
    }

    /**
     * Deletes an Intervention
     * @param  Intervention  $intervention Intervention to be deleted
     * @return int        Row of the deleted Intervention
     */
    public function delete(Intervention $intervention)
    {
        return $this->InterventionRepo->delete($intervention->id); 
    }
}