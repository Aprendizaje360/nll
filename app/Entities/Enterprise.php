<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

//Trait for sending notifications in laravel
use Illuminate\Notifications\Notifiable;

//Notification for Seller
use App\Notifications\EnterprisesResetPasswordNotification;

use Illuminate\Foundation\Auth\User as Authenticatable;

use Carbon\Carbon;
/**
 * EL tipo de usuario empresa. Vienen a ser los clientes de los clientes. 
 */
class Enterprise extends Authenticatable
{
    //Mass assignable attributes
	protected $fillable = [
	    'name', 'email', 'password', 'parent_enterprise_id', 'identification_number',
	    'identification_type_id', 'enabled',
	];

	  //hidden attributes
	protected $hidden = [
	   'password', 'remember_token',
	];

	public function sendPasswordResetNotification($token)
	{
	   $this->notify(new SellerResetPasswordNotification($token));
	}

	public function employees()
	{
		return $this->hasMany(User::class);
	}

	public function roles()
	{
		return $this->belongsToMany(EnterpriseRole::class, 'enteprises_roles_rel', 'enterprise_id', 'role_id');
	}

	public function licenses()
	{
		return $this->hasMany(License::class);
	}

	public function identificationType()
	{
		return $this->belongsTo(IdentificationType::class, 'identification_type_id');
	}
	
	public function interventions()
	{
		return $this->belongsToMany(Intervention::class, 'ent_int_rel')->withPivot('has_permission');
	}

	public function getClerks()
	{
		return Enterprise::where('parent_enterprise_id', $this->id)->get();
	}

	public function parent()
	{
		return Enterprise::where('id', $this->parent_enterprise_id)->first();
	}

	public function getPermittedInterventions()
	{
		return $this->interventions()->wherePivot('has_permission', true);
	}

	public function hasPermission($intervention)
	{
		if ($this->parent_enterprise_id == null)
		{
			return true;
		}
		
		$permittedInterventions = $this->getPermittedInterventions()->get();

		if ($permittedInterventions->contains($intervention))
		{
			return true;
		}
			
	}

	public function getRelatedLicense($intervention)
	{
		return $this->licenses()->where('intervention_id', $intervention->id)
								->where('expiration_date','>' ,Carbon::now())
								->whereRaw('total_uses < uses')
								->first();
	}
}
