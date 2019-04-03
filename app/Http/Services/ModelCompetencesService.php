<?php

namespace App\Http\Services;

//Repositories
use App\Http\Repositories\ModelCompetencesRepository;
use App\Http\Repositories\CompetenceRepository;

//Entities
use App\Entities\ModelCompetences;

/**
 * Class that handles interaction with the admin repository and other needed logic
 */

class ModelCompetencesService
{
	protected $modelCompetencesRepo;
    protected $competenceRepo;

    /**
     * Instantiates the modelCompetencesRepo variable
     * @param ModelCompetencesRepository $modelCompetencesRepo Instance of admin repository
     */
    public function __construct(ModelCompetencesRepository $modelCompetencesRepo, CompetenceRepository $competenceRepo)
    {
    	$this->modelCompetencesRepo = $modelCompetencesRepo;
        $this->competenceRepo = $competenceRepo;
    }

    /**
     * Returns all instances of all types of admin
     * @return Collection Collection of admins
     */
    public function all()
    {
    	return $this->modelCompetencesRepo->all();
    }

    /**
     * Stores an admin, sets role of admin and sends an email with the admin info 
     * @param  Request $request Attributes for the new admin
     * @return null             Null
     */
    public function store($request)
    {

        $path = \Storage::putFile('pdfs', $request->file('pdf'));

        $request->merge(['pdf_path' => $path]);

        return $this->modelCompetencesRepo->create($request->all()); 
    }

    /**
     * Updates an admin
     * @param  Request $request Attributes to be used in the update process
     * @param  Admin  $modelCompetences   Admin to be updated
     * @return Admin          Updated admin
     */
    public function update($request, ModelCompetences $modelCompetences)
    {      
        if ($request->file('pdf'))
        {
            \Storage::disk('local')->delete($modelCompetences->pdf_path);

            $path = \Storage::putFile('pdfs', $request->file('pdf'));

            $request->merge(['pdf_path' => $path]);
        }

        return $this->modelCompetencesRepo->update($request->all(), $modelCompetences);
    }

    /**
     * Deletes an Admin
     * @param  Admin  $modelCompetences Admin to be deleted
     * @return int        Row of the deleted admin
     */
    public function delete(ModelCompetences $modelCompetences)
    {
        foreach ($modelCompetences->competences as $competence)
        {
            $competence->levels()->delete();
        }

        $modelCompetences->competences()->delete();

        \Storage::disk('local')->delete($modelCompetences->pdf_path);

        return $this->modelCompetencesRepo->delete($modelCompetences->id); 
    }

    /**
     * Get model competences that have atleast 1 competence of each type
     */
    public function getCompletedModels()
    {
        return $this->modelCompetencesRepo->all()->filter(function ($model)
        {
            $transversalComps = $model->competences()->transversal()->get();
            $functionalComps = $model->competences()->functional()->get();

            if ($transversalComps->count() > 0 && $functionalComps->count() > 0)
            {
                return true;
            }
            else
            {
                return false;
            }
        });
    }
}