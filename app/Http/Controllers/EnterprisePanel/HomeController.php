<?php

namespace App\Http\Controllers\EnterprisePanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//Entities
use App\Entities\Enterprise;

use Carbon\Carbon;

/**
 * Class that handles the interaction between the client and the services for Enterprises
 */
class HomeController extends Controller
{
    /**
     * It requires an Enterprise service and Enterprise type service instance
     * @param EnterpriseService $enterpriseServ Instance of the Enterprise service
     * @param EnterpriseTypeService $enterpriseTypeServ Instance of the Enterprise type service
     */
    public function __construct()
    {
    }

    public function home(Request $request)
    {
    	$enterprise = \Auth::guard('web_enterprise')->user();

        foreach ($enterprise->licenses as $license)
        {
            if ($license->expiration_date > Carbon::now())
            {
                $days = Carbon::now()->diffInDays(Carbon::parse($license->expiration_date));
                if ($days <= 15)
                {
                    $request->session()->flash('danger', 'Intervencion ' . $license->intervention->title . ' esta a ' . $days . ' de expirar!');
                }
            }
        }

    	return view('enterprise.home', compact('enterprise'));
    }
}
