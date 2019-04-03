<?php

namespace App\Http\Controllers\AdminPanel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//Entities
use App\Entities\ModelCompetences;

//Requests
use App\Http\Requests\ModelCompetences\StoreModelCompetences;
use App\Http\Requests\ModelCompetences\UpdateModelCompetences;
use App\Http\Requests\ModelCompetences\DeleteModelCompetences;

//Services
use App\Http\Services\ModelCompetencesService;
use App\Http\Services\CompetenceTypeService;
/**
 * Class that handles the interaction between the client and the services for ModelCompetences
 */
class ModelCompetencesController extends Controller
{
    protected $modelCompetenceServ;
    protected $competenceTypeServ;
    /**
     * It requires an ModelCompetence service and ModelCompetence type service instance
     * @param modelCompetencesService $modelCompetenceServ Instance of the ModelCompetence service
     * @param ModelCompetenceTypeService $modelCompetenceTypeServ Instance of the ModelCompetence type service
     */
    public function __construct(ModelCompetencesService $modelCompetenceServ, CompetenceTypeService $competenceTypeServ)
    {
        $this->modelCompetenceServ = $modelCompetenceServ;
        $this->competenceTypeServ = $competenceTypeServ;
    }
	/**
	 * Lists all ModelCompetence users and shows interfaces for 
	 * CRD operations
	 * @return void
	 */
    public function index()
    {
        $modelsCompetences = $this->modelCompetenceServ->all();

        return view('admin.modelCompetences.dashboard', compact('modelsCompetences'));
    }

    /**
     * Show a model competences with its competences
     */
    public function show(ModelCompetences $modelCompetences)
    {
        $competences = $modelCompetences->competences;

        $competenceTypes = $this->competenceTypeServ->all();

        return view('admin.modelCompetences.show', compact('modelCompetences', 'competences', 'competenceTypes' ));
    }

    /**
     * Stores a new ModelCompetence user
     * @param  Request $request 
     * @return void
     */
    public function store(StoreModelCompetences $request)
    {
        $this->modelCompetenceServ->store($request);

        return back();
    }

    /**
     * view to edit an ModelCompetence user
     * @param  Request $request 
     * @param  ModelCompetence   $modelCompetence  
     * @return void
     */
    public function edit(ModelCompetences $modelCompetences)
    {
        return view('admin.modelCompetences.edit', compact('modelCompetences'));
    }

    /**
     * Update an ModelCompetence
     * @param  Request $request 
     * @param  ModelCompetence   $modelCompetence   
     * @return void
     */
    public function update(UpdateModelCompetences $request, ModelCompetences $modelCompetences)
    {
        $this->modelCompetenceServ->update($request, $modelCompetences);

        $request->session()->flash('success', 'Modelo de competencia modificado');

        return back();
    }

    /**
     * Delete an ModelCompetence user and flashes a message of success
     * @param  Request $request
     * @param  ModelCompetence   $modelCompetences
     * @return void
     */
    public function delete(DeleteModelCompetences $request, ModelCompetences $modelCompetences)
    {
        $this->modelCompetenceServ->delete($modelCompetences);
        
        $request->session()->flash('success', 'Modelo de competencia eliminado');

        return back();
    }
}
