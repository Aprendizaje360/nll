<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * Tipos de competencia que existen
 */
class CompetenceType extends Model
{
	public function competences()
	{
		return $this->hasMany(Competence::class);	
	}
}
