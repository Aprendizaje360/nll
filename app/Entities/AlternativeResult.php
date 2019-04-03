<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class AlternativeResult extends Model
{
	protected $fillable = [
	    'alternative_id', 'sequence_result_id', 'competence_result_id'
	];

    public function sequenceResult()
    {
    	return $this->belongsTo(SequenceResult::class, 'sequence_result_id');
    }

    public function alternative()
    {
    	return $this->belongsTo(Alternative::class, 'alternative_id');
    }
}
