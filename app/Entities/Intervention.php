<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

//Entities
use App\Entities\UserInterventionResult;

class Intervention extends Model
{
    protected $fillable = [
      'title', 'description', 'model_competences_id', 'welcome_text', 'introduction', 'case_introduction', 'final_text', 'support_mail'
    ];

    public function licenses()
    {
    	return $this->HasMany(License::class);
    }

    public function sequences()
    {
        return $this->hasMany(Sequence::class)->orderBy('order', 'asc');
    }
    
    public function modelCompetences()
    {
        return $this->belongsTo(ModelCompetences::class, 'model_competences_id');
    }

    public function enterprises()
    {
        return $this->belongsToMany(Enterprise::class, 'ent_int_rel')->withPivot('has_permission');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_int_rel', 'int_id', 'user_id');
    }

    public function userWithResults()
    {
        return $this->belongsToMany(User::class, 'user_int_res_rel', 'int_id', 'user_id');
    }

    public function getNextSequence()
    {   
        $sequences = $this->modelCompetences->sequences->all();

        return $interventions;
    }

    public function getRemainingSequences()
    {
        $availableSeq = collect([1, 2, 3 ,4]);

        $sequences = $this->modelCompetences->sequences;

        $seqIndexes = $sequences->pluck('order');

        return $availableSeq->diff($seqIndexes);
    }

    public function getRemainingSequencesAndCurrent($seq)
    {
        $availableSeq = collect([1, 2, 3 ,4]);

        $sequences = $this->modelCompetences->sequences;

        $seqIndexes = $sequences->pluck('order')->diff([$seq->order]);

        return $availableSeq->diff($seqIndexes);
    }

    public function getLicenseFromEnterprise($enterprise)
    {
        return $this->licenses()
                    ->where('enterprise_id', $enterprise->id)
                    ->first();
    }

    public function getLatestInterventionPivotModel($user)
    {
        return UserInterventionResult::where('int_id', $this->id)
                                   ->where('user_id', $user->id)
                                   ->orderBy('created_at', 'DESC')
                                   ->first();
    }

}
