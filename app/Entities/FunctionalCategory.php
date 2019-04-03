<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class FunctionalCategory extends Model
{
	protected $fillable = [
      'label','sequence_id'
    ];

    public function sequence()
    {
    	return $this->belongsTo(Sequence::class, 'sequence_id');
    }

    public function alternatives()
    {
    	return $this->hasMany(Alternative::class);
    }
}
