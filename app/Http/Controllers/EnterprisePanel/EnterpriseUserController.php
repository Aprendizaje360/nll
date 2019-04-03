<?php

namespace App\Http\Controllers\EnterprisePanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//Services
use App\Http\Services\EnterpriseService;
use App\Http\Services\EnterpriseTypeService;

//Entities
use App\Entities\Enterprise;

//Requests
use App\Http\Requests\Enterprise\StoreEnterprise;
use App\Http\Requests\Enterprise\UpdateEnterprise;
use App\Http\Requests\Enterprise\DeleteEnterprise;
use App\Http\Requests\EnterpriseClerks\StoreClerk;
use App\Http\Requests\EnterpriseClerks\UpdateClerk;
use App\Http\Requests\EnterpriseClerks\DeleteClerk;

/**
 * Class that handles the interaction between the client and the services for Enterprises
 */
class EnterpriseUserController extends Controller
{
    protected $enterpriseServ;
    /**
     * It requires an Enterprise service and Enterprise type service instance
     * @param EnterpriseService $enterpriseServ Instance of the Enterprise service
     * @param EnterpriseTypeService $enterpriseTypeServ Instance of the Enterprise type service
     */
    public function __construct(EnterpriseService $enterpriseServ)
    {
        $this->enterpriseServ = $enterpriseServ;
    }

    /**
     * Shows the create clerk view
     * @param  Enterprise $enterprise Parent enterprise
     * @return View                   view
     */
    public function createClerk(Enterprise $enterprise)
    {
        return view('enterprise.clerks.create', compact('enterprise'));
    }


    /**
     * Stores a new Enterprise clerk
     * @param  Request $request Contains the parameters of the new clerk
     * @return Back             Black
     */
    public function storeClerk(StoreClerk $request, Enterprise $enterprise)
    {
        $this->enterpriseServ->storeClerk($request, $enterprise);

        return back();
    }

    /**
     * Returns edit clerk view
     * @param  Nothing     $request   Nothing
     * @param  Enterprise $enterprise Clerk to edit
     * @return view                   View
     */
    public function editClerk(Enterprise $enterprise)
    {
        $clerk = $enterprise;

        $enterprise = $enterprise->parent();

        return view('enterprise.clerks.edit', compact('clerk', 'enterprise'));
    }

    /**
     * Stores a new Enterprise clerk
     * @param  UpdateEnterprise
     * @param  Enterprise
     * @return back
     */
    public function updateClerk(UpdateClerk $request, Enterprise $enterprise)
    {
        $this->enterpriseServ->updateClerk($request, $enterprise);

        return back();
    }

    /**
     * Deletes an enterprise clerk
     * @param  Request $request
     * @param  Enterprise   $enterprise
     * @return void
     */
    public function deleteClerk(DeleteEnterprise $request, Enterprise $enterprise)
    {
        $this->enterpriseServ->delete($enterprise);

        $request->session()->flash('success', 'Clerk eliminado');

        return back();
    }
}
