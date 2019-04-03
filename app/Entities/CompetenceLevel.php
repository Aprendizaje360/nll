<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * Reṕresenta los niveles con sus descripciones de una competencia
 */
class CompetenceLevel extends Model
{
	protected $fillable = [
      'technical_description','amicable_description', 'report_description', 'competence_id', 'level'
    ];

    public function alternatives()
    {
    	return $this->hasMany(Alternative::class);
    }

    public function competence()
    {
    	return $this->belongsTo(Competence::class);
    }
}
