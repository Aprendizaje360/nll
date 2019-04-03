<?php

namespace App\Http\Controllers\AdminPanel;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//Services 
use App\Http\Services\EnterpriseService;
use App\Http\Services\InterventionService;
use App\Http\Services\IdentificationTypeService;

//Entities
use App\Entities\Enterprise;

//Requests
use App\Http\Requests\Enterprise\StoreEnterprise;
use App\Http\Requests\Enterprise\UpdateEnterprise;
use App\Http\Requests\Enterprise\DeleteEnterprise;

/**
 * Class that handles the interaction between the client and the services for Enterprises
 */
class EnterpriseController extends Controller
{
    protected $enterpriseServ;
    protected $identificationTypeServ;
    protected $interventionServ;
    /**
     * Instantiates the enterprise service
     * @param EnterpriseService $enterpriseServ Instance of the enterprise service
     */
    public function __construct(EnterpriseService $enterpriseServ, IdentificationTypeService $identificationTypeServ,
                                InterventionService $interventionServ)
    {
        $this->enterpriseServ = $enterpriseServ;
        $this->identificationTypeServ = $identificationTypeServ;
        $this->interventionServ = $interventionServ;
    }
	/**
	 * Lists all enterprises and shows interfaces for 
	 * CRD operations
	 * @return void
	 */
    public function index()
    {
        $enterprises = $this->enterpriseServ->allWithoutClerks()->get();

        $identificationTypes = $this->identificationTypeServ->all();

        return view('admin.enterprises.dashboard', compact('enterprises', 'identificationTypes'));
    }

    /**
     * Shows the licenses of an enterprise
     */
    public function show(Enterprise $enterprise)
    {
        $licenses = $enterprise->licenses;

        $interventions = $this->interventionServ->all();

        return view('admin.enterprises.show', compact('enterprise', 'licenses', 'interventions'));
    }

    /**
     * Stores a new enterprise user
     * @param  Request $request 
     * @return void
     */
    public function store(StoreEnterprise $request)
    {
        $this->enterpriseServ->store($request);
        $request->session()->flash('success', 'Empresa agregada');

        return back();
    }

    /**
     * view to edit an enterprise
     * @param  Request $request 
     * @param  Enterprise   $enterprise  
     * @return void
     */
    public function edit(Request $request, Enterprise $enterprise)
    {
        $identificationTypes = $this->identificationTypeServ->all();
        return view('admin.enterprises.edit', compact('enterprise', 'identificationTypes'));
    }

    /**
     * Update an Enterprise
     * @param  Request $request 
     * @param  Enterprise   $Enterprise   
     * @return void
     */
    public function update(UpdateEnterprise $request, Enterprise $Enterprise)
    {
        $this->enterpriseServ->update($request, $Enterprise);
        $request->session()->flash('success', 'Empresa modificada');

        return back();
    }

    /**
     * Delete an Enterprise user and flashes a message of success
     * @param  Request $request
     * @param  Enterprise   $Enterprise
     * @return void
     */
    public function delete(DeleteEnterprise $request, Enterprise $enterprise)
    {
        $this->enterpriseServ->delete($enterprise);
        $request->session()->flash('success', 'Empresa eliminada');

        return back();
    }
}
