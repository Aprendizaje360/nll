<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class IdentificationType extends Model
{
    public function enterprises()
    {
    	return $this->hasMany(Enterprise::class);	
    }
}
