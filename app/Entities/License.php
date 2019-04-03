<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class License extends Model
{
	protected $fillable = [
	    'enterprise_id', 'intervention_id', 'currently_enrolled', 'uses','total_uses', 'expiration_date', 'expired'
	];

    public function enterprise()
    {
    	return $this->belongsTo(Enterprise::class, 'enterprise_id');
    }

    public function intervention()
    {
    	return $this->belongsTo(Intervention::class, 'intervention_id');
    }

    public function licenseOrders()
    {
        return $this->hasMany(LicenseOrder::class);
    }

    public function getEnableDateAttribute($value)
    {
        $time = strtotime($value);

        $newformat = date('Y-m-d',$time);

        return $newformat;
    }

    public function getExpirationDateAsFormat($format)
    {
        $date = new \Date($this->expiration_date);

        return $date->format($format);
    }
}
