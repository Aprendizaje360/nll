<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class VideoResult extends Model
{
	protected $fillable = [
	    'video_id', 'sequence_result_id'
	];

    public function video()
    {
    	return $this->belongsTo(Video::class, 'video_id');
    }

    public function sequenceResults()
    {
    	return $this->belongsTo(SequenceResult::class, 'sequence_result_id');
    }
}
