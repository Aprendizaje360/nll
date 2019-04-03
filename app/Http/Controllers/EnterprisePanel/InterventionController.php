<?php

namespace App\Http\Controllers\EnterprisePanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//Services
use App\Http\Services\InterventionService;

//Entities
use App\Entities\Intervention;
use App\Entities\Enterprise;

//Requests

/**
 * Class that handles the interaction between the client and the services for Interventions
 */
class InterventionController extends Controller
{
    protected $interventionServ;
    /**
     * It requires an Intervention service and Intervention type service instance
     * @param InterventionService $interventionServ Instance of the Intervention service
     * @param InterventionTypeService $interventionTypeServ Instance of the Intervention type service
     */
    public function __construct(InterventionService $interventionServ)
    {
        $this->interventionServ = $interventionServ;
    }
	/**
	 * Lists all Intervention users and shows interfaces for 
	 * CRD operations
	 * @return void
	 */
    public function show(Enterprise $enterprise, Intervention $intervention)
    {
        $employees = $enterprise->employees()->fromIntervention($intervention);
        if (isset($_GET['q'])) {
            $employees->where('name', 'LIKE', '%' . $_GET['q'] . '%')
                ->orWhere('lastName', 'LIKE', '%' . $_GET['q'] . '%');
            $employees = $employees->paginate(15);
            $employees = $employees->appends(['q' => $_GET['q']]);
        } else {
            $employees = $employees->paginate(15);
        }
            

        return view('enterprise.interventions.show', compact('enterprise', 'intervention', 'employees'));
    }


    /**
     * Downloads the PDF file attached previously when creating the model compettences related to an intervention
     * @param  Enterprise   $enterprise   Enteprise (not used)
     * @param  Intervention $intervention Used to retrieve the PDF
     * @return Response                     A Response
     */
    public function downloadPDF(Request $request, Enterprise $enterprise, Intervention $intervention)
    {
        $path = $intervention->modelCompetences->pdf_path;

        if (!$path)
        {
            $request->session()->flash('danger', 'No hay un pdf registrado');

            return back();
        }

        $path = storage_path('/app/' . $path);

        if ($path == null)
        {
            $request->flash('No tiene un pdf subido');

            return;
        }

        $filename = basename($path);

        $headers = ['Content-Type' => 'application/pdf'];

        return response()->download($path, $filename, $headers);
    }

    /**
     * Shows the report graphs. The data and graps are handled by javascript and a library called chart.js
     * @param  Request      $request      Contains non-important parameters
     * @param  Enterprise   $enterprise   Enterprise to get the report from
     * @param  Intervention $intervention Intervention to get the report from
     * @return View                       View
     */
    public function showReports(Request $request, Enterprise $enterprise, Intervention $intervention)
    {
        return view('enterprise.reports.index');
    }
}
