<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Predominant extends Model
{
    protected $fillable = ['name', 'value', 'competence_result_id'];
}
