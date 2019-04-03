<?php

namespace App\Http\Services;

//Repositories
use App\Http\Repositories\ModelCompetencesRepository;
use App\Http\Repositories\CompetenceLevelRepository;
use App\Http\Repositories\CompetenceRepository;

//Entities
use App\Entities\Competence;

/**
 * Class that handles interaction with the admin repository and other needed logic
 */

class CompetenceService
{
     protected $competenceRepo;
     protected $competenceLevelRepo;

     /**
      * Instantiates the modelCompetencesRepo variable
      * @param ModelCompetencesRepository $modelCompetencesRepo Instance of admin repository
      */
     public function __construct(CompetenceRepository $competenceRepo, CompetenceLevelRepository $competenceLevelRepo)
     {
        $this->competenceRepo = $competenceRepo;
        $this->competenceLevelRepo = $competenceLevelRepo;
     }

 //    /**
 //     * Returns all instances of all types of admin
 //     * @return Collection Collection of admins
 //     */
 //    public function all()
 //    {
 //    	return $this->modelCompetencesRepo->all();
 //    }

    /**
     * Stores an admin, sets role of admin and sends an email with the admin info 
     * @param  Request $request Attributes for the new admin
     * @return null             Null
     */
    public function store($request)
    {

        $competence =  $this->competenceRepo->create($request->all()); 

        for ($i = 1; $i < 5; $i++)
        {
            $this->competenceLevelRepo->create(['technical_description' => $request['description_m_' . $i],
                                                'amicable_description' => $request['description_h_' . $i],
                                                'report_description' => $request['description_r_' . $i],
                                                'level' => $i,
                                                'competence_id' => $competence->id
                                                ]);
        }
    }

    /**
     * Updates an admin
     * @param  Request $request Attributes to be used in the update process
     * @param  Admin  $modelCompetences   Admin to be updated
     * @return Admin          Updated admin
     */
    public function update($request, Competence $competence)
    {   
        
        $this->competenceRepo->update($request->all(), $competence);

        foreach ($competence->levels as $i=>$level)
        {
            $index = $i + 1;
            $this->competenceLevelRepo->update(['technical_description' => $request['description_m_' . $index],
                                                'amicable_description' => $request['description_h_' . $index],
                                                'report_description' => $request['description_r_' . $index]
                                                ], $level);
        }

    }

    /**
     * Deletes an Admin
     * @param  Admin  $modelCompetences Admin to be deleted
     * @return int        Row of the deleted admin
     */
    public function delete(Competence $competence)
    {
        $competence->levels()->delete();

        return $this->competenceRepo->delete($competence->id); 
    }
}