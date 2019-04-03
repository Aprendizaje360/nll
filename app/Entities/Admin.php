<?php

namespace App\Entities;


//Class which implements Illuminate\Contracts\Auth\Authenticatable
use Illuminate\Foundation\Auth\User as Authenticatable;

//Trait for sending notifications in laravel
use Illuminate\Notifications\Notifiable;

/**
 * Viene a ser los superadmins y super clerks que controlaran la aplicación en general.
 */
class Admin extends Authenticatable
{
	use Notifiable;
	use Traits\AdminHasRoles;

    //Mass assignable attributes
	protected $fillable = [
	  'name', 'lastName', 'email', 'password',
	];

	//hidden attributes
	protected $hidden = [
	   'password', 'remember_token',
	];

	//Send password reset notification
	public function sendPasswordResetNotification($token)
	{
	  $this->notify(new AdminResetPasswordNotification($token));
	}

	public function roles()
	{
		return $this->belongsToMany(AdminRole::class, 'admins_roles_rel', 'admin_id', 'role_id');
	}

	/**
	 * Returns true if it is the last admin with the role name passed
	 * @param  string  $roleName The role name
	 * @return boolean           If it is the last admin
	 */
	public function isLastOfRole($roleName)
	{
		return (Admin::whereHas('roles', function ($q) use ($roleName){
			$q->where('name', $roleName);
		})->count() == 1);
	}

	/**
	 * Returns a number greater than 0 (true) if admin has role
	 * @param string  $roleName The name of the role that is being cheked
	 * @return boolean           True if admin has role otherwise false
	 */
	public function hasRole($roleName)
	{
		 $currentRole = $this->roles()->where('name', $roleName);
        
        return $currentRole->count(); 
	}
}
