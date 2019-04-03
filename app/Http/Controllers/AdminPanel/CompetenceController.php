<?php

namespace App\Http\Controllers\AdminPanel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//Entities
use App\Entities\Competence;

//Requests
use App\Http\Requests\Competence\StoreCompetence;
use App\Http\Requests\Competence\UpdateCompetence;
use App\Http\Requests\Competence\DeleteCompetence;

//Services
use App\Http\Services\CompetenceService;
use App\Http\Services\CompetenceTypeService;



class CompetenceController extends Controller
{
	protected $competenceServ;
    protected $competenceTypeServ;
    /**
     * It requires an ModelCompetence service and ModelCompetence type service instance
     * @param modelCompetencesService $competenceServ Instance of the ModelCompetence service
     * @param ModelCompetenceTypeService $modelCompetenceTypeServ Instance of the ModelCompetence type service
     */
    public function __construct(CompetenceService $competenceServ, CompetenceTypeService $competenceTypeServ)
    {
        $this->competenceServ = $competenceServ;
        $this->competenceTypeServ = $competenceTypeServ;        
    }
    
    public function store(StoreCompetence $request)
    {
        $this->competenceServ->store($request);
        $request->session()->flash('success', 'Competence agregada');

        return back();
    }

    public function edit(Competence $competence)
    {
        $competenceTypes = $this->competenceTypeServ->all();

        return view('admin.competences.edit', compact('competence', 'competenceTypes'));
    }

    public function update(UpdateCompetence $request, Competence $competence)
    {
        $this->competenceServ->update($request, $competence);
        $request->session()->flash('success', 'Competence editada');

        return back();
    }

    /**
     * Delete an ModelCompetence user and flashes a message of success
     * @param  Request $request
     * @param  ModelCompetence   $modelCompetences
     * @return void
     */
    public function delete(DeleteCompetence $request, Competence $competence)
    {
        $this->competenceServ->delete($competence);
        $request->session()->flash('success', 'Competence eliminado');

        return back();
    }

    public function retrieveLevels(Request $request, Competence $competence)
    {
        try 
        {
            $competenceLevels = $competence->levels;

            return response([
                'statusCode'=> 200,
                'status'=>'success',
                'message'=>'Se encontraron items',
                'levels' => $competenceLevels
                ], 200);       
        }
        catch(\Exception $exception)
        {
            return response([
                "status"=> "error",
                "message"=> $exception->getMessage() . $exception->getTraceAsString()
                ], 500);
        }
    }
}