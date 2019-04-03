<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $table = 'logs';
    protected $fillable = [
        'name', 'description', 'result_id'
    ];
}
