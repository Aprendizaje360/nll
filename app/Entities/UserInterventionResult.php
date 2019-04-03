<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class UserInterventionResult extends Model
{
    //Mass assignable attributes
    protected $fillable = [
        'user_id', 'int_id', 'results_id'
    ];

    protected $table = 'user_int_res_rel';

    public function intervention()
    {
    	return $this->belongsTo(Intervention::class, 'int_id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function result()
    {
        return $this->belongsTo(InterventionResult::class, 'result_id');
    }
}
