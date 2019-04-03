<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class InterventionResult extends Model
{
	protected $fillable = [
		'begins', 'ends'
	];

    public function userWithIntervention()
    {
    	return $this->hasOne(UserInterventionResult::class, 'result_id');
    }

    public function museRawData()
    {
    	return $this->hasMany(MuseRawData::class);
    }

    public function sequenceResults()
    {
    	return $this->hasMany(SequenceResult::class)->orderBy('order', 'asc');
    }
}
