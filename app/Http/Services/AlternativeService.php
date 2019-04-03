<?php

namespace App\Http\Services;

//Repositories
use App\Http\Repositories\AlternativeRepository;

//Entities

/**
 * Class that handles interaction with the admin repository and other needed logic
 */

class AlternativeService
{
     protected $AlternativeRepo;

     /**
      * Instantiates the modelCompetencesRepo variable
      * @param ModelCompetencesRepository $modelCompetencesRepo Instance of admin repository
      */
     public function __construct(AlternativeRepository $alternativeRepo)
     {
        $this->alternativeRepo = $alternativeRepo;
     }

     /**
      * Wizardo storudo
      */
     public function wizardStore($request, $sequence, $intervention)
     {
        $tComp = $sequence->retrieveTransversalCompetence();

        $tFirstLevel = $tComp->levels->where('level', 1)->first();
        $tSecondLevel = $tComp->levels->where('level', 2)->first();
        $tThirdLevel = $tComp->levels->where('level', 3)->first();
        $tFourthLevel = $tComp->levels->where('level', 4)->first();


        $this->alternativeRepo->create([
                'text' => $request['transversal_alt_level_1'],
                'sequence_id' => $sequence->id,
                'competence_level_id' => $tFirstLevel->id,
                'level' => 1 
            ]);

        $this->alternativeRepo->create([
                'text' => $request['transversal_alt_level_2'],
                'sequence_id' => $sequence->id,
                'competence_level_id' => $tSecondLevel->id,
                'level' => 2 
            ]);

        $this->alternativeRepo->create([
                'text' => $request['transversal_alt_level_3'],
                'sequence_id' => $sequence->id,
                'competence_level_id' => $tThirdLevel->id,
                'level' => 3 
            ]);

        $this->alternativeRepo->create([
                'text' => $request['transversal_alt_level_4'],
                'sequence_id' => $sequence->id,
                'competence_level_id' => $tFourthLevel->id,
                'level' => 4 
            ]);
     }  

     /**
      * Updates alternatives
      */
     public function wizardUpdate($request, $sequence)
     {
        $alternatives = $sequence->alternatives;

        $tComp = $sequence->retrieveTransversalCompetence();

        $tFirstLevel = $tComp->levels->where('level', 1)->first();
        $tSecondLevel = $tComp->levels->where('level', 2)->first();
        $tThirdLevel = $tComp->levels->where('level', 3)->first();
        $tFourthLevel = $tComp->levels->where('level', 4)->first();
        
        $this->alternativeRepo->update([
                'text' => $request['transversal_alt_level_1'],
                'competence_level_id' => $tFirstLevel->id,
                'level' => 1
            ], $alternatives[0]);

        $this->alternativeRepo->update([
                'text' => $request['transversal_alt_level_2'],
                'competence_level_id' => $tSecondLevel->id,
                'level' => 2
            ], $alternatives[1]);

        $this->alternativeRepo->update([
                'text' => $request['transversal_alt_level_3'],
                'competence_level_id' => $tThirdLevel->id,
                'level' => 3
            ], $alternatives[2]);

        $this->alternativeRepo->update([
                'text' => $request['transversal_alt_level_4'],
                'competence_level_id' => $tFourthLevel->id,
                'level' => 4
            ], $alternatives[3]);
     }

    /**
     * Returns all instances of all types of admin
     * @return Collection Collection of admins
     */
    public function all()
    {
    	return $this->alternativeRepo->all();
    }


}