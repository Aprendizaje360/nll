<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class MuseRawAlternativeData extends Model
{
    protected $table = 'muse_raw_alternative_data';

    protected $fillable = [
      'alpha_absolute','beta_absolute', 'delta_absolute', 'theta_absolute', 'gamma_absolute',
      'timestamp', 'alternative_result_id'
    ];

    public function alternativeResult()
    {
    	return $this->belongsTo(alternativeResult::class, 'alternative_result_id');
    }
}
