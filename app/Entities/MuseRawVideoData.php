<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class MuseRawVideoData extends Model
{
    protected $table = "muse_raw_video_data";

    protected $fillable = [
      'alpha_absolute','beta_absolute', 'delta_absolute', 'theta_absolute', 'gamma_absolute',
      'timestamp', 'video_result_id'
    ];
    
    public function videoResult()
    {
    	return $this->belongsTo(videoResult::class, 'video_result_id');
    }
}
