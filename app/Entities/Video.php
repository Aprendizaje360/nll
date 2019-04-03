<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
	protected $fillable = [
      'video_path'
    ];

    public function sequences()
    {
    	return $this->belongsToMany(Sequence::class, 'sequence_video_rel');
    }
}
