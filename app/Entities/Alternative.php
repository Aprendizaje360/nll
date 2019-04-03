<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Alternative extends Model
{
	protected $fillable = [
      'text','competence_level_id', 'sequence_id', 'enabled', 'level', 'functional_category_id'
    ];

	public function competenceLevel()
	{
		return $this->belongsTo(CompetenceLevel::class, 'competence_level_id');
	}

	public function sequences()
	{
		return $this->belongsTo(Sequence::class, 'sequence_id');
	}

	public function functionalCategory()
	{
		return $this->belongsTo(functionalCategory::class, 'functional_category_id');
	}

	public function alternativeResults()
	{
		return $this->hasMany(AlternativeResult::class);
	}

	public function getType()
	{
		return $this->competenceLevel->competence->competenceType;
	}
} 
