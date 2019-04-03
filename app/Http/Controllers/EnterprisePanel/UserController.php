<?php

namespace App\Http\Controllers\EnterprisePanel;

use Mail;
use App\Entities\User;
use App\Mail\EmailToken;

//Services
use App\Mail\EmailResults;
use App\Entities\Enterprise;

//Entities
use App\Jobs\SendTokenEmail;
use Illuminate\Http\Request;
use App\Entities\Intervention;

//Requests
use App\Http\Services\UserService;
use App\Http\Controllers\Controller;

//Jobs
use App\Http\Requests\EnterpriseUsers\UpdateUser;
use App\Http\Requests\EnterpriseUsers\UploadUsers;

/**
 * Class that handles the interaction between the client and the services for Enterprises
 */
class UserController extends Controller
{
    protected $userServ;

    /**
     * It requires an Enterprise service and Enterprise type service instance
     * @param EnterpriseService $enterpriseServ Instance of the Enterprise service
     * @param EnterpriseTypeService $enterpriseTypeServ Instance of the Enterprise type service
     */
    public function __construct(UserService $userServ)
    {
        $this->userServ = $userServ;
    }

	/**
	 * Uploads an excel with all the users 
     * @param  Request  $request          Contains the File. 
     * @param  Enterprise   $enerprise    Enterprise currently logged 
     * @param  Intervention $intervention Intervention that the users have access to 
	 * @return Back                       In Black
	 */
    public function upload(UploadUsers $request, Enterprise $enterprise, Intervention $intervention)
    {
        try
        {    
            \DB::beginTransaction();

            $this->userServ->upload($request, $enterprise, $intervention);

            $request->flash('Im not the one I thought I always knew');

            \DB::commit();

        }
        catch(\Exception $e)
        {
            throw $e;
            
            \DB::rollback();
        }

        return back();
    }

    /**
     * Downloaods the users related to the table
     * @param  Request  $request          Nothing. 
     * @param  Enterprise   $enerprise    Enterprise currently logged 
     * @param  Intervention $intervention Intervention that the users have access to
     * @return Back                       Backerino
     */
    public function download(Request $request, Enterprise $enterprise, Intervention $intervention)
    {


        $this->userServ->download($request, $enterprise, $intervention);

        $request->flash('Voice without a sound. A sound that no one cares to hear');

        return back();
    }

    /**
     * Sends the token related to the intervention to the email of the user
     * @param  Request     $request      Nothing of importance
     * @param  Intevention $intervention Intervention related to the token
     * @param  User        $user         User to send the token to
     * @return void                      Nothing of importance
     */
    public function sendToken(User $user, Intervention $intervention)
    {
        $token = $user->getTokenFromIntervention($intervention);
        $email = new EmailToken($user, $token, $intervention);
        Mail::to($user->email_company)->send($email);
        session(['message' => "El token ha sido enviado con éxito."]);
        return back();
    }
    
    /**
     * Returns the edit view of users
     * @param  User   $user User to be edited
     * @return Edit       View
     */
    public function edit( Request $request, Enterprise $enterprise, Intervention $intervention, User $user )
    {
        return view('enterprise.users.edit', compact('enterprise', 'intervention', 'user' ));
    }
    
    /**
     * Updates a user
     * @param  Request $request Holds the update attribute
     * @param  User    $user    User To be updated
     * @return Back             ToBlack
     */
    public function update(UpdateUser $request, User $user)
    {
        $this->userServ->update($request,$user);
        
        $request->session()->flash('success', 'Se actualizo el empleado');
        
        return back();
    }
    
    /**
     * Deletes a user
     * @param  Intervention $intervention Relationship to the intervention will be deleted
     * @param  User         $user         User to be removed  from this intervention
     * @return back                       black
     */
    public function delete(Request $request, Intervention $intervention, User $user)
    {
        $this->userServ->deleteInterventionRel($intervention, $user);
        
        $request->session()->flash('success', 'Usuario eliminado');
        
        return back();
    }
    
    /**
     * Undocumented function
     *
     * @param User $user
     * @param Intervention $intervention
     * @return void
     */
    public function getResults(User $user, Intervention $intervention)
    {
        $result;
        $interventionResult = $user->getInterventionResult($intervention);
        if (isset($interventionResult->json) && !empty($interventionResult->json)) {
            $result = json_decode($interventionResult->json);
        } else {
            $result = \DB::select("select c.competence_id as competenceId, 
                cl.report_description as label,
                group_concat(case p.name when 'watching' then p.value end) watching,
                group_concat(case p.name when 'reflecting' then p.value end) reflecting,
                group_concat(case p.name when 'responding' then p.value end) responding
                from competence_results c join competence_levels cl
                on c.competence_level_id = cl.level and c.competence_id = cl.competence_id join predominants p
                on c.id = p.competence_result_id
                where c.intervention_result_id = ". $interventionResult->results_id ."
                group by c.competence_id, cl.report_description");
        }
        $date = $interventionResult->created_at->format('M d, Y');
        \PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
        $pdf = \PDF::loadView('enterprise.users.result', compact('user', 'result', 'date'));
        $pdf->setPaper('A4', 'portrait');
        return $pdf->download($interventionResult->created_at->format('d-m-Y') .'_'.$user->name.'_'.$user->lastName.'_resultado.pdf');
        // dd(json_decode($result));
        // return view('enterprise.users.result', compact('user', 'result', 'date'));

    }

    /**
     * Sends the results related to the intervention to the email of the user
     * @param  Request     $request      Nothing of importance
     * @param  Intevention $intervention Intervention related to the token
     * @param  User        $user         User to send the token to
     * @return void                      Nothing of importance
     */
    public function sendResults(User $user, Intervention $intervention)
    {
        $email = new EmailResults($user, $intervention);
        Mail::to($user->email_company)->send($email);
        session(['message' => "Los resultados han sido enviados con éxito."]);
        return back();
    }
    
    
}
