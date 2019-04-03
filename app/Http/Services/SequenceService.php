<?php

namespace App\Http\Services;

//Repositories
use App\Http\Repositories\SequenceRepository;
use App\Http\Repositories\CompetenceRepository;

//Entities
use App\Entities\Sequence;

/**
 * Class that handles interaction with the admin repository and other needed logic
 */

class SequenceService
{
     protected $sequenceRepo;
     protected $competenceRepo;

     /**
      * Instantiates the modelCompetencesRepo variable
      * @param ModelCompetencesRepository $modelCompetencesRepo Instance of admin repository
      */
     public function __construct(SequenceRepository $sequenceRepo, CompetenceRepository $competenceRepo)
     {
        $this->sequenceRepo = $sequenceRepo;
        $this->competenceRepo = $competenceRepo;
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
        return $this->sequenceRepo->create($request->all()); 
    }

    /**
     * Store method used in the big form
     */
    public function wizardStore($request, $intervention)
    {
        $path = \Storage::putFile('background_images', $request->file('background_image'));

        $sequence = $this->sequenceRepo->create([
                'title' => $request['title'],
                'reflexive_text' => $request['reflexive_text'],
                'description' => $request['description'],
                'order' => $request['order'],
                'model_competences_id' => $intervention->modelCompetences->id,
                'intervention_id' => $intervention->id,
                'transversal_question' => $request['transversal_question'],
                'functional_question' => $request['functional_question'],
                'background_image' => $path
            ]);

        $tcompetence =  $this->competenceRepo->find($request['transversal_competence_id']);
        $fcompetence = $this->competenceRepo->find($request['functional_competence_id']);
        $sequence->competences()->attach($tcompetence);
        $sequence->competences()->attach($fcompetence);

        return $sequence;
    }

    public function wizardUpdate($request, $sequence)
    {
        $path;

        if ($request->file('background_image'))
        {
            \Storage::disk('local')->delete($sequence->background_image);

            $path = \Storage::putFile('background_image', $request->file('background_image'));
        }
        else 
        {
            $path = $sequence->background_image;
        }

        $this->sequenceRepo->update([
                'title' => $request['title'],
                'reflexive_text' => $request['reflexive_text'],
                'description' => $request['description'],
                'order' => $request['order'],
                'transversal_question' => $request['transversal_question'],
                'functional_question' => $request['functional_question'],
                'background_image' => $path
            ], $sequence);

        $sequence->competences()->detach();

        $tcompetence =  $this->competenceRepo->find($request['transversal_competence_id']);
        $fcompetence = $this->competenceRepo->find($request['functional_competence_id']);

        $sequence->competences()->attach($tcompetence);
        $sequence->competences()->attach($fcompetence);
        return $sequence;
    }

    /**
     * Updates an admin
     * @param  Request $request Attributes to be used in the update process
     * @param  Admin  $modelCompetences   Admin to be updated
     * @return Admin          Updated admin
     */
    public function update($request, Sequence $sequence)
    {   
        return $this->sequenceRepo->update($request->all(), $sequence); 
    }


    /**
     * Deletes the sequence
     */
    public function delete(Sequence $sequence)
    {
        $sequence->alternatives()->delete();

        \Storage::disk('local')->delete($sequence->videos[0]->video_path);

        \Storage::disk('local')->delete($sequence->videos[1]->video_path);

        $sequence->videos()->delete();

        \Storage::disk('local')->delete($sequence->background_image);

        return $this->sequenceRepo->delete($sequence->id); 
    }
}