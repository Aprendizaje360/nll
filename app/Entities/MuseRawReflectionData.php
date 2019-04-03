<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class MuseRawReflectionData extends Model
{
    protected $table = "muse_raw_reflection_data";

    protected $fillable = [
      'alpha_absolute','beta_absolute', 'delta_absolute', 'theta_absolute', 'gamma_absolute',
      'timestamp', 'sequence_result_id'
    ];
    
    public function sequenceResult()
    {
    	return $this->belongsTo(sequenceResult::class, 'sequence_result_id');
    }
}
