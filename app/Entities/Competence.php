<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * Representa las competencias
 */
class Competence extends Model
{   
    protected $fillable = [
      'name','label', 'model_competences_id', 'competence_type_id', 'description'
    ];

    public function competenceType()
    {
    	return $this->belongsTo(CompetenceType::class, 'competence_type_id');
    }

    public function modelCompetence()
    {
        return $this->belongsTo(ModelCompetences::class, 'model_competences_id');
    }
    
    public function levels()
    {
        return $this->hasMany(CompetenceLevel::class);
    }

    public function sequences()
    {
        return $this->belongsToMany(Sequence::class, 'sequence_competence_rel');
    }

    public function scopeTransversal($query)
    {
        return $query->where('competence_type_id', 1);
    }

    public function scopeFunctional($query)
    {
        return $query->where('competence_type_id', 2);
    }
}
