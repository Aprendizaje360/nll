<?php

namespace App\Http\Services;

//Repositories
use App\Http\Repositories\LicenseRepository;
use App\Http\Repositories\LicenseOrderRepository;

//Entities
use App\Entities\License;

//Jobs
use App\Jobs\SendLicenseInfoEmail;

/**
 * Class that handles interaction with the License repository and other needed logic
 */
class LicenseService
{
	protected $licenseRepo;
    protected $licenseOrderRepo;

    /**
     * Instantiates the LicenseRepo variable
     * @param LicenseRepository $licenseRepo Instance of License repository
     */
    public function __construct(LicenseRepository $licenseRepo, LicenseOrderRepository $licenseOrderRepo)
    {
    	$this->licenseRepo = $licenseRepo;
        $this->licenseOrderRepo = $licenseOrderRepo;
    }

    /**
     * Returns all instances of all types of License
     * @return Collection Collection of Licenses
     */
    public function all()
    {
    	return $this->licenseRepo->all();
    }

    /**
     * Stores an License, sets role of License and sends an email with the License info 
     * @param  Request $request Attributes for the new License
     * @return null             Null
     */
    public function store($request)
    {
        //Crates the license
        $newLicense = $this->licenseRepo->create($request->all()); 

        $enterprise = $newLicense->enterprise;

        //Attaches permission to access the intervention with the license
        $enterprise->interventions()->attach($newLicense->intervention, ['has_permission' => true]);

        //Create the initial order
        $this->licenseOrderRepo->create([
                                        'license_id' => $newLicense->id,
                                        'new_expiration_date' => $newLicense->expiration_date,
                                        'uses_added' => $newLicense->total_uses,
                                        'observations' => 'Creación'
            ]);
    }

    /**
     * Updates an License
     * @param  Request $request Attributes to be used in the update process
     * @param  License  $license   License to be updated
     * @return Nothing             Hollow Knight
     */
    public function update($request, License $license)
    {       
        //To get the number of uses added
        $previousUses = $license->total_uses;

        //Updates License
        $this->licenseRepo->update($request->all(), $license);

        //Crates new license Order
        $this->licenseOrderRepo->create([
                                        'license_id' => $license->id,
                                        'new_expiration_date' => $license->expiration_date,
                                        'uses_added' => $license->total_uses - $previousUses,
                                        'observations' => 'Ninguna'
            ]);
    }

    /**
     * Deletes an License (Currently Not Used)
     * @param  License  $license License to be deleted
     * @return int        Row of the deleted License
     */
    public function delete(License $license)
    {
        $license->licenseOrders()->delete();

        return $this->licenseRepo->delete($license->id); 
    }
}