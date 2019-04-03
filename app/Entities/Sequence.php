<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Sequence extends Model
{
	protected $fillable = [
      'title','background_image_path','reflexive_text','description', 
      'order', 'model_competences_id', 'intervention_id',
      'transversal_question', 'functional_question'
    ];

    public function intervention()
    {
        return $this->belongsTo(Intervention::class, 'intervention_id');
    }

    public function modelCompetences()
    {
        return $this->belongsTo(ModelCompetences::class, 'model_competences_id');
    }

    public function videos()
    {
        return $this->belongsToMany(Video::class, 'sequence_video_rel');
    }

    public function competences()
    {
        return $this->belongsToMany(Competence::class, 'sequence_competence_rel');
    }

    public function alternatives()
    {
        return $this->hasMany(Alternative::class);
    }

    public function functionalCategories()
    {
        return $this->hasMany(FunctionalCategory::class);
    }

    public function retrieveTransversalCompetence()
    {

        return $this->competences->where('competence_type_id', 1)->first();
    }

    public function retrieveFunctionalCompetence()
    {
        return $this->competences->where('competence_type_id', 2)->first();
    }

    public function retrieveTransversalVideo()
    {
        return $this->videos()->wherePivot('used_in_transversal', true)->first();
    }

    public function retrieveFunctionalVideo()
    {
        return $this->videos()->wherePivot('used_in_transversal', false)->first();   
    }

    public function getFunctionalAlternativesOrderedByLevel()
    {
        $alternatives = $this->alternatives;

        $falternatives = $alternatives->filter(function ($alternative)
        {
            return $alternative->getType()->id == 2;
        });

        return $falternatives->sortBy('level');
    }

    public function getTransversalAlternativesOrderedByLevel()
    {

        $alternatives = $this->alternatives;

        $talternatives = $alternatives->filter(function ($alternative)
        {
             return $alternative->getType()->id == 1;
        });

        return $talternatives->sortBy('level');
    }
}
