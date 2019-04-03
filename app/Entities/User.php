<?php

namespace App\Entities;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Entities\UserInterventionResult;

use Carbon\Carbon;

class User extends Authenticatable
{
    use HasApiTokens;
    use Notifiable;
    use Traits\UserHasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'lastName', 'telephone', 'enabled',
        'birth_date', 'gender', 'area', 'sector', 'email_company', 'work_position',
        'year_experience', 'academic_degree', 'academic_field', 'country_residence',
        'city_residence', 'country_birth', 'city_birth', 'password', 'email', 'enabled',
        'enterprise_id', 'token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function enterprise()
    {
        return $this->belongsTo(Enterprise::class, 'enterprise_id');
    }

    public function roles()
    {
        return $this->belongsToMany(UserRole::class, 'users_roles_rel');
    }

    public function interventions()
    {
        return $this->belongsToMany(Intervention::class, 'user_int_rel', 'user_id', 'int_id');
    }

    public function interventionsWithResults()
    {
        return $this->belongsToMany(Intervention::class, 'user_int_date_rel', 'user_id', 'int_id');
    }

    public function interventionResults()
    {
        return $this->belongsToMany(InterventionResult::class, 'user_int_res_rel', 'user_id', 'results_id');
    }

    //Age accesor calculated  between birth date and today
    public function getAgeAttribute()
    {
        return Carbon::parse($this->birth_date)->age;
    }

    public function getInterventionResult($intervention)
    {
        return UserInterventionResult::where('user_id', $this->id)
            ->where('int_id', $intervention->id)
            ->orderBy('created_at', 'DESC')->first();
    }

    public function getTokenFromIntervention($intervention)
    {
        return $this->token;
    }

    public function isRelatedToIntervention($intervention)
    {
        return $this->interventions()->where('id', $intervention->id)->first();
    }

    /**
     * Function used to validate the password given when retrieving a token for a user
     * If mindiwave we use the token atrtibute instead of password
     * @param  String   $password Password given in the json 
     * @return Boolean           True or False depending if the user has the given token
     */
    public function validateForPassportPasswordGrant($password)
    {
        return ($password == $this->token) ? true : false;
    }

    /**
     * Function used to retrieve the user with the given username. 
     * In mindwave we use the email_company attribute instead of email
     * @param  String $username username given in the json file
     * @return Boolean          True or false depending if the user is found
     */
    public function findForPassport($username)
    {
        return User::where('email_company', $username)->first();
    }

    
    //Uses the intervention relation to get the users related to an specific intervention
    public function ScopeFromIntervention($query, $intervention)
    {
        return $query->whereHas('interventions', function($query) use ($intervention)
                        {
                            $query->where('id', $intervention->id);
                        });
    }

}
