<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class CompetenceResult extends Model
{
	protected $fillable = [
      'score', 'competence_id', 'competence_level_id', 'intervention_result_id'
    ];

    public function interventionResult()
    {
    	return $this->belongsTo(InterventionResult::class, 'intervention_result_id');
    }

    public function competence()
    {
    	return $this->belongsTo(Competence::class, 'competence_id');
    }

    public function competenceLevel()
    {
    	return $this->belongsTo(CompetenceLevel::class, 'competence_level_id');
    }
}
