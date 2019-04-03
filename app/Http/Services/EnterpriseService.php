<?php

namespace App\Http\Services;

//Repos
use App\Http\Repositories\EnterpriseRepository;

//Entities
use App\Entities\Enterprise;

//Jobs
use App\Jobs\SendClerkLoginInfoEmail;
/**
 * Class that handles interaction with the Enterprise repository and other needed logic
 */
class EnterpriseService
{
	protected $enterpriseRepo;

    /**
     * Instantiates the EnterpriseRepo variable
     * @param EnterpriseRepository $EnterpriseRepo Instance of Enterprise repository
     */
    public function __construct(EnterpriseRepository $enterpriseRepo)
    {
    	$this->enterpriseRepo = $enterpriseRepo;
    }

    /**
     * Returns all instances of all types of Enterprise
     * @return Collection Collection of Enterprises
     */
    public function all()
    {
    	return $this->enterpriseRepo->all();
    }

    /**
     * Returns all enterprises that are not clerks
     * @return Collection Collection of enterprsies
     */
    public function allWithoutClerks()
    {
        return $this->enterpriseRepo->where(['parent_enterprise_id' => null]);
    }

    /**
     * Stores an Enterprise
     * @param  Request $request Attributes for the new Enterprise
     * @return Enterprise          New instance of Enterprise
     */
    public function store($request)
    {
        $request->merge(['password' => bcrypt($request['password'])]);
        $request->merge(['enabled' =>($request['enabled']) ? true : false ]);
        $enterprise = $this->enterpriseRepo->create($request->all()); 

        $this->enterpriseRepo->setEnterpriseRole($enterprise, 1);

        return $enterprise;
    }

    /**
     * Stores an enterprise clerk
     * @param  Request $request          Attributes to be used in the creation process
     * @param  Enterprise  $enterprise   Parent Enterprise
     * @return Enterprise                New Enterprise
     */
    public function storeClerk($request, $enterprise)
    {
        //Generates a new password for the clerk
        $pBeforeHash = $this->getToken(8);
        $request->merge(['password' => bcrypt($pBeforeHash)]);
        $request->merge(['enabled' => $enterprise->enabled ]);
        $request->merge(['parent_enterprise_id' => $enterprise->id]);

        //Creates the clerk
        $enterprise_clerk = $this->enterpriseRepo->create($request->all()); 

        //Checks if permission has been given to any of the parent enterprise's interventions
        foreach($enterprise->interventions as $intervention)
        {
            //If it has been checked we attach the intervention to the clerk with permission
            if ($request->has('int' . $intervention->id))
            {
                $enterprise_clerk->interventions()->attach($intervention, ['has_permission' =>true]);
            }
            //Else we just dont give permission
            else 
            {
                $enterprise_clerk->interventions()->attach($intervention);
            }
        }

        $this->enterpriseRepo->setEnterpriseRole($enterprise_clerk, 2);

        dispatch(new SendClerkLoginInfoEmail($enterprise_clerk, $pBeforeHash)); 
    }

    /**
     * Updates an Enterprise
     * @param  Request $request Attributes to be used in the update process
     * @param  Enterprise  $enterprise   Enterprise to be updated
     * @return Enterprise          Updated Enterprise
     */
    public function update($request, Enterprise $enterprise)
    {       
        if ($request['password'] == null) {
            $request->offsetUnset('password');
            $request->offsetUnset('password_confirmation');
        }
        else {
            $request->merge(['password' => bcrypt($request['password'])]);
        }
        $request->merge(['enabled' =>($request['enabled']) ? true : false ]);
        return $this->enterpriseRepo->update($request->all(), $enterprise);
    }

    /**
     * Updates an enterprise clerk
     * @param  Request $request  Conatains attributes to update
     * @param  Enterprise $clerk Clerk to update
     * @return Enterprise        Updated Clerk
     */
    public function updateClerk($request, $clerk)
    {
        //If the password hasn't been set we just remove the fields from the request
        if ($request['password'] == '') {
            $request->offsetUnset('password');
            $request->offsetUnset('password_confirmation');
        }
        else {
            $request->merge(['password' => bcrypt($request['password'])]);
        }
        $request->merge(['enabled' => $clerk->parent()->enabled]);

        //For each intervention we check if permission has been given to the clerk
        foreach($clerk->interventions as $intervention)
        {
            //Retrieve the correspondent intervention
            
            $int = $clerk->interventions()->find($intervention->id);
            //If the intervention has beene checked we attach the intervention if the user doesn't have permission
            if ($request->has('int' . $intervention->id))
            {
                //If the intervention exists change permission to true
                if ($int)
                {
                    $int->pivot->has_permission = true;
                    $int->pivot->save();
                }
                //If the relationship doesn't exist we attach the intervention
                else
                {
                    $clerk->interventions()->attach($intervention, ['has_permission' =>true]);
                }
            }
            //If the intervention hasn't been checked we remove the permission
            else 
            {
                $int->pivot->has_permission = false;
                $int->pivot->save();
            }
        }
        //We update the clerk
        return $this->enterpriseRepo->update($request->all(), $clerk);
    }

    /**
     * Deletes an Enterprise
     * @param  Enterprise  $enterprise Enterprise to be deleted
     * @return int        Row of the deleted Enterprise
     */
    public function delete(Enterprise $enterprise)
    { 
        return $this->enterpriseRepo->delete($enterprise->id); 
    }


    //NOTE: Make it a helper later

    //Functions to generate a random secure number 
    //Source: https://stackoverflow.com/questions/1846202/php-how-to-generate-a-random-unique-alphanumeric-string/13733588#13733588

    private function crypto_rand_secure($min, $max)
    {
        $range = $max - $min;
        if ($range < 1) return $min; // not so random...
        $log = ceil(log($range, 2));
        $bytes = (int) ($log / 8) + 1; // length in bytes
        $bits = (int) $log + 1; // length in bits
        $filter = (int) (1 << $bits) - 1; // set all lower bits to 1
        do {
            $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
            $rnd = $rnd & $filter; // discard irrelevant bits
        } while ($rnd > $range);
        return $min + $rnd;
    }

    private function getToken($length)
    {
        $token = "";
        $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
        $codeAlphabet.= "0123456789";
        $max = strlen($codeAlphabet); // edited

        for ($i=0; $i < $length; $i++) {
            $token .= $codeAlphabet[$this->crypto_rand_secure(0, $max-1)];
        }

        return $token;
    }
}