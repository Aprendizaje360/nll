<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * Roles de la emprepsa que separa entre admin de la empresa y clerk
 */
class EnterpriseRole extends Model
{
	protected $table = 'enterprise_roles';

    public function enterprises()
    {
    	return $this->belongsToMany(Enterprise::class, 'enteprises_roles_rel', 'role_id', 'enterprise_id');
    }
}
