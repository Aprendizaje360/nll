<?php

namespace App\Http\Controllers\AdminPanel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//Entities
use App\Entities\Sequence;
use App\Entities\Intervention;

//Requests
use App\Http\Requests\Sequence\StoreSequence;
use App\Http\Requests\Sequence\UpdateSequence;
use App\Http\Requests\Sequence\DeleteSequence;

//Services
use App\Http\Services\VideoService;
use App\Http\Services\SequenceService;
use App\Http\Services\AlternativeService;
use App\Http\Services\FunctionalCategoryService;


class SequenceController extends Controller
{
    protected $sequenceServ;
    protected $alternativeServ;
    protected $videoServ;
    /**
     * It requires an ModelCompetence service and ModelCompetence type service instance
     * @param modelCompetencesService $competenceServ Instance of the ModelCompetence service
     * @param ModelCompetenceTypeService $modelCompetenceTypeServ Instance of the ModelCompetence type service
     */
    public function __construct(SequenceService $sequenceServ, 
                                AlternativeService $alternativeServ, 
                                VideoService $videoServ,
                                FunctionalCategoryService $functionalCategoryServ)
    {
        $this->sequenceServ = $sequenceServ;
        $this->alternativeServ = $alternativeServ;
        $this->videoServ = $videoServ;
        $this->functionalCategoryServ = $functionalCategoryServ;
    }

    public function create(Intervention $intervention)
    {
        $transversalCompetences = $intervention->modelCompetences->competences()->transversal()->get();

        $functionalCompetences = $intervention->modelCompetences->competences()->functional()->get();

        return view('admin.sequences.create', compact('intervention', 'transversalCompetences', 'functionalCompetences'));
    }

    public function store(StoreSequence $request, Intervention $intervention)
    {
        try{
            \DB::beginTransaction();

            //Stores the sequence first
            $sequence = $this->sequenceServ->wizardStore($request, $intervention);

            //Stores transversal alternatives
            $this->alternativeServ->wizardStore($request, $sequence, $intervention);

            //Stores functional categories and functional alternatives
            $this->functionalCategoryServ->wizardStore($request, $sequence);

            //Stores the videos
            $this->videoServ->wizardStore($request, $sequence);

            $request->session()->flash('success', 'Secuencia creada');

            \DB::commit();

        }catch(\Exception $e){

            throw $e;
            
            \DB::rollback();
        }

        return back();
    }

    public function edit(Sequence $sequence)
    {
        $intervention = $sequence->intervention;

        $transversalCompetences = $intervention->modelCompetences->competences()->transversal()->get();

        $functionalCompetences  = $intervention->modelCompetences->competences()->functional()->get();

        $functionalCategories = $sequence->functionalCategories;

        $transversalAlternatives = $sequence->getTransversalAlternativesOrderedByLevel();

        return view('admin.sequences.edit', compact('sequence', 'intervention', 'alternatives', 'functionalCategories', 'transversalAlternatives', 'transversalCompetences', 
            'functionalCompetences'));
    }

    public function update(UpdateSequence $request, Sequence $sequence)
    {
        try{
            \DB::beginTransaction();

            //Updates the sequence fist
            $sequence = $this->sequenceServ->wizardUpdate($request, $sequence);

            //Then updates the alternative
            $this->alternativeServ->wizardUpdate($request, $sequence);

            //Update the functional categories
            $this->functionalCategoryServ->wizardUpdate($request, $sequence);

            //Then the videos
            $this->videoServ->wizardUpdate($request, $sequence);

            $request->session()->flash('success', 'Secuencia editada');

            \DB::commit();

        }catch(\Exception $e){

            throw $e;
            
            \DB::rollback();
        }

        return back();
    }

    public function delete(DeleteSequence $request, Sequence $sequence)
    {
        $sequence->alternatives()->delete();

        $sequence->functionalCategories()->delete();

        $this->sequenceServ->delete($sequence);
        
        $request->session()->flash('success', 'Secuencia eliminada');

        return back();
    }
}
