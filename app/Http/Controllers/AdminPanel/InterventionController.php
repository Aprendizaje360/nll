<?php

namespace App\Http\Controllers\AdminPanel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//Services
use App\Http\Services\InterventionService;
use App\Http\Services\InterventionTypeService;
use App\Http\Services\ModelCompetencesService;

//Entities
use App\Entities\Intervention;
use App\Entities\ModelCompetences;

//Requests
use App\Http\Requests\Intervention\StoreIntervention;
use App\Http\Requests\Intervention\UpdateIntervention;
use App\Http\Requests\Intervention\DeleteIntervention;

/**
 * Class that handles the interaction between the client and the services for Interventions
 */
class InterventionController extends Controller
{
    protected $interventionServ;
    protected $modelCompetencesServ;

    /**
     * It requires an Intervention service and Intervention type service instance
     * @param interventionService $interventionServ Instance of the Intervention service
     * @param InterventionTypeService $interventionTypeServ Instance of the Intervention type service
     */
    public function __construct(InterventionService $interventionServ, ModelCompetencesService $modelCompetencesServ)
    {
        $this->interventionServ = $interventionServ;
        $this->modelCompetencesServ = $modelCompetencesServ;
    }
	/**
	 * Lists all Intervention users and shows interfaces for 
	 * CRD operations
	 * @return void
	 */
    public function index()
    {
        $interventions = $this->interventionServ->all();

        $modelsCompetences = $this->modelCompetencesServ->getCompletedModels();

        return view('admin.interventions.dashboard', compact('interventions', 'modelsCompetences'));
    }

    public function show(Intervention $intervention)
    {
        $modelCompetences = $intervention->modelCompetences;

        $sequences = $intervention->sequences;

        return view('admin.interventions.show', compact('intervention', 'sequences', 'modelCompetences'));
    }


    /**
     * Stores a new Intervention user
     * @param  Request $request 
     * @return void
     */
    public function store(StoreIntervention $request)
    {
        $this->interventionServ->store($request);

        return back();
    }

    /**
     * view to edit an Intervention user
     * @param  Request $request 
     * @param  Intervention   $intervention  
     * @return void
     */
    public function edit(Request $request, Intervention $intervention)
    {
        $modelsCompetences = $this->modelCompetencesServ->getCompletedModels();
        
        return view('admin.interventions.edit', compact('intervention', 'modelsCompetences'));
    }
    /**
     * Update an Intervention
     * @param  Request $request 
     * @param  Intervention   $intervention   
     * @return void
     */
    public function update(UpdateIntervention $request, Intervention $intervention)
    {
        $this->interventionServ->update($request, $intervention);
        $request->session()->flash('success', 'Intervencion modificado');

        return back();
    }

    /**
     * Delete an Intervention user and flashes a message of success
     * @param  Request $request
     * @param  Intervention   $intervention
     * @return void
     */
    public function delete(DeleteIntervention $request, Intervention $intervention)
    {
        $this->interventionServ->delete($intervention);
        $request->session()->flash('success', 'Intervencion eliminado');

        return back();
    }
}
