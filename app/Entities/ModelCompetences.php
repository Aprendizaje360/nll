<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class ModelCompetences extends Model
{
	//Mass assignable attributes
	protected $fillable = [
	  'name', 'description', 'pdf_path'
	];

	public function interventions()
    {
    	return $this->hasMany(Intervention::class);
    }

    public function competences()
    {
    	return $this->hasMany(Competence::class)->orderBy('competence_type_id');
    }

    public function sequences()
    {
    	return $this->hasMany(Sequence::class)->orderBy('order');
    }

    public function isComplete()
    {
        $transversalComps = $this->competences()->transversal()->get();
        $functionalComps = $this->competences()->functional()->get();

        if ($transversalComps->count() > 0 && $functionalComps->count() > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}
