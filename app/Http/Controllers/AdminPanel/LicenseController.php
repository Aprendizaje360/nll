<?php

namespace App\Http\Controllers\AdminPanel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//Entities
use App\Entities\License;

//Requests
use App\Http\Requests\License\StoreLicense;
use App\Http\Requests\License\UpdateLicense;
use App\Http\Requests\License\DeleteLicense;

//Services
use App\Http\Services\LicenseService;
use App\Http\Services\InterventionService;

/**
 * Class that handles the interaction between the client and the services for License
 */
class LicenseController extends Controller
{
    protected $licenseServ;
    protected $interventionServ;
    /**
     * It requires an ModelCompetence service and ModelCompetence type service instance
     * @param LicenseService $licenseServ Instance of the ModelCompetence service
     */
    public function __construct(LicenseService $licenseServ, InterventionService $interventionServ)
    {
        $this->licenseServ = $licenseServ;
        $this->interventionServ = $interventionServ;
    }


    /**
     * Stores a new ModelCompetence user
     * @param  Request $request 
     * @return void
     */
    public function store(StoreLicense $request)
    {
        $this->licenseServ->store($request);

        return back();
    }

    /**
     * view to edit an ModelCompetence user
     * @param  Request $request 
     * @param  ModelCompetence   $modelCompetence  
     * @return void
     */
    public function edit(License $license)
    {
        $interventions = $this->interventionServ->all();

        return view('admin.licenses.edit', compact('license', 'interventions'));
    }

    /**
     * Update an ModelCompetence
     * @param  Request $request 
     * @param  ModelCompetence   $modelCompetence   
     * @return void
     */
    public function update(UpdateLicense $request, License $license)
    {
        $this->licenseServ->update($request, $license);

        $request->session()->flash('success', 'Licencia modificada');

        return back();
    }

    /**
     * Delete an ModelCompetence user and flashes a message of success
     * @param  Request $request
     * @param  ModelCompetence   $License
     * @return void
     */
    public function delete(DeleteLicense $request, License $license)
    {
        $this->licenseServ->delete($license);

        $request->session()->flash('success', 'Licencia eliminada');

        return back();
    }
}
