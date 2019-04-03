<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class LicenseOrder extends Model
{
	protected $fillable = [
	    'license_id', 'new_expiration_date', 'uses_added', 'observations'
	];

    public function license()
    {
    	return $this->belongsTo(License::class, 'license_id');
    }

    public function getTimeAddedAttribute($value)
    {
        $time = strtotime($value);

        $newformat = date('Y-m-d',$time);

        return $newformat;
    }
}
