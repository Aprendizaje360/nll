<?php

namespace App\Http\Services;

//Repository
use App\Http\Repositories\UserRepository;
use App\Http\Repositories\LicenseRepository;

//Entities
use App\Entities\User;
use App\Entities\Intervention;

//Special libraries used for excel and dates
use Excel;
use Carbon\Carbon;

/**
 * Class that hadles interaction with the User repository ad other needed logic
 */
class UserService
{
	protected $userRepo;
    protected $userIntDateRepo;
    protected $licenseRepo;

    /**
     * Instatiates the userRepo variable
     * @param UserRepository $userRepo instance of User repository
     */
    public function __construct(UserRepository $userRepo,
                                LicenseRepository $licenseRepo)
    {
    	$this->userRepo = $userRepo;
        $this->licenseRepo = $licenseRepo;
    }

    /**
     * Returns all instances of all types of User
     * @return Collection Collection of Users
     */
    public function all()
    {
    	return $this->userRepo->all();
    }

    /**
     * Stores a User
     * @param  Request $request Attributes for the new User
     * @return User             Created user
     */
    public function store($request)
    {
        $request->merge(['enabled' =>($request['enabled']) ? true : false ]);
        $request->merge(['password' => bcrypt($request['password'])]);
        return $this->userRepo->create($request->all());
    }

    /**
     * Updates a User
     * @param  Request $request Attributes to be used in the update process
     * @param  User  $User   User to be updated
     * @return User          Updated User
     */
    public function update($request, User $user)
    {
        $request->merge(['enabled' =>($request['enabled']) ? true : false ]);
        return $this->userRepo->update($request->all(), $user);
    }

    /**
     * Basic Delete
     * @param  User  $user User to be deleted
     * @return int        Row of the deleted User
     */
    public function delete(User $user)
    {
        return $this->userRepo->delete($user->id);
    }

    /**
     * Function used to delete the membership of a user to a specific intervention
     * @param  User         $user         User that belongs to the membership
     * @param  Intervention $intervention Intervention that the user is in
     * @return void                       The call of the void
     */
    public function deleteInterventionRel(Intervention $intervention, User $user)
    {
        $enterprise = $user->enterprise;

        $license = $intervention->getLicenseFromEnterprise($enterprise);

        //Reduce users enrolled with that license
        $this->licenseRepo->update(['currently_enrolled' => $license->currently_enrolled - 1], $license);

        //Detach the intervention from the user
        $user->interventions()->detach($intervention);
    }

    /**
     * Uses an excel file to register employees of an enterprise
     * @param  Covfefe $request    Contains excel file
     * @param  Covfefe $enterprise Employer's Enterprise
     * @return Void                Void
     */
    public function upload($request, $enterprise, $intervention)
    {
        $file = $request->file('excel');

        Excel::selectSheetsByIndex(0)->load($file->getPathName(), function($reader) use ($enterprise, $intervention)
        {
            $reader->ignoreEmpty();
            $reader->takeColumns(7);

            $rows = $reader->get();
            //Gets the license related to that intervention and stores the numbers of uses in a variable
            $license = $intervention->getLicenseFromEnterprise($enterprise);

            $uses = $license->uses;
            $tuses = $license->total_uses;
            $enrolled = $license->currently_enrolled;

            foreach($rows as $row)
            {

                //If the maximum number of uses has been reached
                if ($uses == $tuses)
                {
                    $request->flash('danger', 'Se alcanzó el máximo número de licencias y no se pudo inscribir a más');
                    break;
                }

                //If the maximum number of people enrolled has been reached
                if ($enrolled == $tuses)
                {
                    $request->flash('danger', 'Se alcanzó el máximo número de inscritos');
                    break;
                }

                //If there is no more data
                if (!$row->nombre) { break; }

                //Create the token
                $token = $this->getToken(5);

                //Check if the user exists
                $user = $this->userRepo->where(['email_company' => $row->email])->first();

                //If the user exists
                if ($user)
                {
                    //Update the user with the excel info
                    $this->userRepo->update([
                            'name' => $row->nombre,
                            'lastName' => $row->apellido,
                            'birth_date' => $row->fecha_nacimiento,
                            'gender' => $row->genero,
                            'area' => $row->area,
                            'sector' => $row->sector,
                            'email_company' => $row->email,
                            'token' => $token,
                        ], $user);
                    //If the user isn't related to the intervention attach the relation
                    if (!$user->isRelatedToIntervention($intervention))
                    {
                        $enrolled += 1;
                        $user->interventions()->attach($intervention);
                    }

                }
                //If the user doesn't exist
                else
                {
                    //Increase the number of uses for the license
                    $enrolled += 1;

                    //Create the user
                    $user = $this->userRepo->create([
                            'name' => $row->nombre,
                            'lastName' => $row->apellido,
                            'birth_date' => $row->fecha_nacimiento,
                            'gender' => $row->genero,
                            'area' => $row->area,
                            'sector' => $row->sector,
                            'email_company' => $row->email,
                            'enterprise_id' => ($enterprise->parent_enterprise_id) ? $enterprise->parent_enterprise_id : $enterprise->id,
                            'enabled' => true,
                            'token' => $token,
                        ]);

                    //Create the new pivot model
                    $user->interventions()->attach($intervention);
                }
            }

            //Update currently enrolled people
            $this->licenseRepo->update(['currently_enrolled' => $enrolled], $license);

        });
    }

    /**
     * Function used to create an excel like the one you upload but with all the useres
     * @param  Request $request        Contains nothing of importance
     * @param  Enterprise $enterprise  Users belong to the enterprise
     * @param  Intervention $intervention  Intervention related to the users
     * @return Void                         Call from the void
     */
    public function download($request, $enterprise, $intervention)
    {
        return Excel::create(Carbon::now() . '_' . $enterprise->name . '_' . $intervention->title . '_usuarios', function($excel) use ($enterprise, $intervention)
        {
            $excel->sheet('Usuarios Subidos', function($sheet) use ($enterprise, $intervention)
            {
                $sheet->appendRow(array(
                    'Nombre',
                    'Apellido',
                    'Fecha Nacimiento',
                    'Genero',
                    'Area',
                    'Sector',
                    'Email',
                    'Posicion Trabajo',
                    'Años de Experiencia',
                    'Grado Académico',
                    'Campo Académico',
                    'País de Residencia',
                    'Ciudad de Residencia',
                    'País de Nacimiento',
                    'Ciudad de Nacimiento',
                    'Correo Personal'
                ));

                //Get the users realted to the intervention
                $users = $enterprise->employees()->fromIntervention($intervention)->get();

                //Append information to the row
                foreach ($users as $user)
                {
                    $sheet->appendRow(array(
                        $user->name,
                        $user->lastName,
                        $user->birth_date,
                        $user->gender,
                        $user->area,
                        $user->sector,
                        $user->email_company,
                        $user->work_position,
                        $user->year_experience,
                        $user->academic_degree,
                        $user->academic_field,
                        $user->country_residence,
                        $user->city_residence,
                        $user->country_birth,
                        $user->city_birty,
                        $user->email
                    ));
                }
            });
        })->download('xlsx');
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