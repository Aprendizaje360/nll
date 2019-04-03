<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * Roles del admin: super clerk y super admin
 */
class AdminRole extends Model
{
    public function admins()
	{
		return $this->belongsToMany(Admin::class);
	}
}
