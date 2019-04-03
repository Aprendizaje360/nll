<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class SequenceResult extends Model
{
    //Mass assignable attributes
	protected $fillable = [
	    'order', 'sequence_id', 'intervention_result_id'
	];

	public function interventionResult()
	{
		return $this->belongsTo(InterventionResult::class, 'intervention_result_id');
	}

	public function sequence()
	{
		return $this->belongsTo(Sequence::class, 'sequence_id');
	}

	public function alternativeResults()
	{
		return $this->hasMany(AlternativeResult::class);
	}
	
	public function videoResults()
	{
		return $this->hasMany(VideoResult::class);
	}
}
