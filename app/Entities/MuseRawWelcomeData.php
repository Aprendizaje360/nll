<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class MuseRawWelcomeData extends Model
{
    protected $table = 'muse_raw_welcome_data';

    protected $fillable = [
      'alpha_absolute','beta_absolute', 'delta_absolute', 'theta_absolute', 'gamma_absolute',
      'timestamp', 'intervention_result_id'
    ];

    public function interventionResult()
    {
    	return $this->belongsTo(interventionResult::class, 'intervention_result_id');
    }
}
