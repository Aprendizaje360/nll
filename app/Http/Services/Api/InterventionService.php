<?php

namespace App\Http\Services\Api;

//Repositories
use App\Entities\Intervention;
use App\Entities\Predominant;
use App\Http\Repositories\AlternativeResultRepository;
use App\Http\Repositories\CompetenceResultRepository;
use App\Http\Repositories\InterventionRepository;
use App\Http\Repositories\InterventionResultRepository;
use App\Http\Repositories\LicenseRepository;
use App\Http\Repositories\MuseRawAlternativeDataRepository;
use App\Http\Repositories\MuseRawCaseIntroductionDataRepository;
use App\Http\Repositories\MuseRawIntroductionDataRepository;
use App\Http\Repositories\MuseRawReflectionDataRepository;
use App\Http\Repositories\MuseRawVideoDataRepository;
use App\Http\Repositories\MuseRawWelcomeDataRepository;
use App\Http\Repositories\SequenceRepository;
use App\Http\Repositories\SequenceResultRepository;
use App\Http\Repositories\UserInterventionResultRepository;
use App\Http\Repositories\UserRepository;
use App\Http\Repositories\VideoResultRepository;
use Illuminate\Support\Facades\DB;

/**
 * Class that handles interaction with the Intervention repository and other needed logic
 */
class InterventionService
{
	protected $userRepo;
    protected $licenseRepo;
    protected $sequenceRepo;
    protected $interventionRepo;
    protected $interventionResultRepo;
    protected $competenceResultRepo;
    protected $userInterventionResultRepo;
    protected $sequenceResultRepo;
    protected $alternativeResultRepo;
    protected $videoResultRepo;
    protected $museRawAlternativeDataRepo;
    protected $museRawReflectionDataRepo;
    protected $museRawVideoDataRepo;
    protected $museRawWelcomeDataRepo;
    protected $museRawIntroductionDataRepo;
    protected $museRawCaseIntroductionDataRepo;

    /**
     * Instantiates the InterventionRepo variable
     * @param InterventionRepository $interventionRepo Instance of Intervention repository
     */
    public function __construct(UserRepository $userRepo,
                                LicenseRepository $licenseRepo,
                                SequenceRepository $sequenceRepo,
                                InterventionRepository $interventionRepo,
                                InterventionResultRepository $interventionResultRepo,
                                CompetenceResultRepository $competenceResultRepo,
                                UserInterventionResultRepository $userInterventionResultRepo,
                                SequenceResultRepository $sequenceResultRepo,
                                AlternativeResultRepository $alternativeResultRepo,
                                VideoResultRepository $videoResultRepo,
                                MuseRawAlternativeDataRepository $museRawAlternativeDataRepo,
                                MuseRawReflectionDataRepository $museRawReflectionDataRepo,
                                MuseRawVideoDataRepository $museRawVideoDataRepo,
                                MuseRawWelcomeDataRepository $museRawWelcomeDataRepo,
                                MuseRawIntroductionDataRepository $museRawIntroductionDataRepo,
                                MuseRawCaseIntroductionDataRepository $museRawCaseIntroductionDataRepo)
    {
        $this->userRepo = $userRepo;
        $this->licenseRepo = $licenseRepo;
        $this->sequenceRepo = $sequenceRepo;
        $this->interventionRepo = $interventionRepo;
        $this->interventionResultRepo = $interventionResultRepo;
        $this->competenceResultRepo = $competenceResultRepo;
        $this->userInterventionResultRepo = $userInterventionResultRepo;
        $this->sequenceResultRepo = $sequenceResultRepo;
        $this->alternativeResultRepo = $alternativeResultRepo;
        $this->videoResultRepo = $videoResultRepo;
        $this->museRawAlternativeDataRepo = $museRawAlternativeDataRepo;
        $this->museRawReflectionDataRepo = $museRawReflectionDataRepo;
        $this->museRawVideoDataRepo = $museRawVideoDataRepo;
        $this->museRawWelcomeDataRepo = $museRawWelcomeDataRepo;
        $this->museRawIntroductionDataRepo = $museRawIntroductionDataRepo;
        $this->museRawCaseIntroductionDataRepo = $museRawCaseIntroductionDataRepo;
    }

    /**
     * Finds an intervention with its id
     * @param  $integer     $interventionId Intervention id
     * @return Intervention                 Intervention found
     */
    public function findIntervention($interventionId)
    {
        return $this->interventionRepo->find($interventionId);
    }

        /**
     * Stores intervention result data. Json structure can be found in mindwave's google drive.
     * @param  Request            $request Contains parameteres
     * @return InterventionResult          Instance of intervention result class
     */
    public function parseAndStoreResultsData($request, $csvResults)
    {
        $jsonResult = [];
        $enterpriseId     = $request['IdEmpresa'];
        $userId           = $request['IdUsuario'];
        $interventionId   = $request['IdIntervencion'];
        $interventionData = $request['InterventionResult'];

        $begins = $interventionData['TiempoInicio'];
        $ends   = $interventionData['TiempoFin'];

        //Create empty intervention result
        $interventionResult = $this->interventionResultRepo->create([
            'begins' => $begins,
            'ends' => $ends,
        ]);

        //Create the user intiervention result instance
        $resultInstance = $this->userInterventionResultRepo->create([
            'user_id' => $userId,
            'int_id' => $interventionId,
            'results_id' => $interventionResult->id
        ]);
        
        //Secuencias
        $sequences = $interventionData['Secuencias'];

        $transversalAlternatives = [];
        $transversalCompetenceId = 0;

        //Iterate over the sequences
        foreach ($sequences as $sequence)
        {
            //Retrieve sequence Id
            $sequenceId = $sequence['IdSecuencia'];

            //Retrieve the sequence for its order
            $sequenceObj = $this->sequenceRepo->find($sequenceId);

            //Create the sequence result instance
            $sequenceResult = $this->sequenceResultRepo->create([
                'sequence_id' => $sequenceId,
                'order' => $sequenceObj->order,
                'intervention_result_id' => $interventionResult->id
            ]);

            //Retrieve competences
            $competences = $sequence['Competencias'];

            //Iterate over competences
            foreach ($competences as $competence)
            {
                //SI ES TRANSVERSAL
                if ($competence['IsTransversal']) {
                    foreach ($competence['Alternativas'] as $alternative) {
                        $alternative['SequenceId'] = $sequenceResult->id;
                        $transversalAlternatives[] = $alternative;
                        $transversalCompetenceId = $competence['IdCompetencia'];
                    }
                } else {
                    $score = 0;
                    $predominants = [];

                    foreach ($competence['Alternativas'] as $alternative) {
                        $score = $score + $alternative['Level'];
                    }
                    $competenceLevelId = round($score / count($competence['Alternativas']));

                     // CALCULAR EL PERCENTIL
                    $percentileResult = DB::table('perecentil_averages')
                                        ->where('min','<=', $score)
                                        ->where('max','>=', $score)
                                        ->where('competence_id', $competence['IdCompetencia'])
                                        ->first();
                    $jsonResult[] = [
                        'competenceId' => $competence['IdCompetencia'],
                        'label' => $percentileResult->label
                    ];

                    //Create the competence result instance
                    $competenceResult = $this->competenceResultRepo->create([
                        'competence_id' => $competence['IdCompetencia'],
                        'competence_level_id' => $competenceLevelId,
                        'intervention_result_id' => $interventionResult->id,
                        'score' => $score,
                        'label' => $percentileResult->label
                    ]);

                    // PREDOMINANTE
                    foreach ($csvResults as $k => $v) {
                        $result = explode("_", $k);
                        if ($competence['IdCompetencia'] == $result[0]) {
                            $predominants[] = [
                                'name' => strtolower($result[1]),
                                'value' => $v['predominant'],
                                'competence_result_id' => $competenceResult->id,
                                'created_at' => date('Y-m-d H:i:s'),
                                'updated_at' => date('Y-m-d H:i:s')
                            ];
                        }
                    }
                    Predominant::insert($predominants);

                    // Storing the chosen alternatives
                    foreach ($competence['Alternativas'] as $alternative) {
                        //Create the alternative result instance related to the sequence
                        $this->alternativeResultRepo->create([
                            'alternative_id' => $alternative['IdAlternativa'],
                            'sequence_result_id' => $sequenceResult->id,
                            'competence_result_id' => $competenceResult->id,
                        ]);
                    }

                   
                }
            }       
        }

        // TRANSVERSAL
        $score = 0;
        $transversalPredominant = [];

        foreach ($transversalAlternatives as $alternative) {
            $score = $score + $alternative['Level'];
        }
        $competenceLevelId = round($score / count($transversalAlternatives));

        // CALCULAR EL PERCENTIL
        $percentileResult = DB::table('perecentil_averages')
                            ->where('min','<=', $score)
                            ->where('max','>=', $score)
                            ->where('competence_id', $transversalCompetenceId)
                            ->first();
                     
        $jsonResult[] = [
            'competenceId' => $transversalCompetenceId,
            'label' => $percentileResult->label
        ];

        //Create the competence result instance
        $competenceResult = $this->competenceResultRepo->create([
            'competence_id' => $transversalCompetenceId,
            'competence_level_id' => $competenceLevelId,
            'intervention_result_id' => $interventionResult->id,
            'score' => $score,
            'label' => $percentileResult->label
        ]);

        // PREDOMINANTE
        foreach ($csvResults as $k => $v) {
            $result = explode("_", $k);
            if ($transversalCompetenceId == $result[0]) {
                $transversalPredominant[] = [
                    'name' => strtolower($result[1]),
                    'value' => $v['predominant'],
                    'competence_result_id' => $competenceResult->id,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ];
            }
        }
        Predominant::insert($transversalPredominant);

        // Storing the chosen alternatives
        foreach ($transversalAlternatives as $alternative) {
            //Create the alternative result instance related to the sequence
            $this->alternativeResultRepo->create([
                'alternative_id' => $alternative['IdAlternativa'],
                'sequence_result_id' => $alternative['SequenceId'],
                'competence_result_id' => $competenceResult->id,
            ]);
        }
        // END TRANSVERSAL
        
        // USA LICENCIA
        $this->useLicense($enterpriseId, $interventionId);

        // SE PONEN LOS PREDOMINANTES EN EL RESULTADO
        foreach ($csvResults as $k => $v) {
            $result = explode("_", $k);
            
            foreach ($jsonResult as $key => $value) {
                if ($value['competenceId'] == $result[0]) {
                    $jsonResult[$key][strtolower($result[1])] = $v['predominant'];
                }
            }
        }

        // Saving the result
        $resultInstance->json = json_encode($jsonResult);
        $resultInstance->save();

        \App\Entities\Log::create(['name' => 'DATA_CONTENT_OK', 'result_id' => $resultInstance->id]);
        //Return the created json comepetences result
        return $jsonResult;
    }

    /**
     * Use license +1
     * @param  int $enterpriseId   
     * @param  int $interventionId 
     * @return boolean
     */
    public function useLicense($enterpriseId, $interventionId)
    {
        //Retrieve license related to the enterprise and intervention
        $license = $this->licenseRepo->where(['enterprise_id' => $enterpriseId,
                                              'intervention_id' => $interventionId])
                                     ->first();
        //Update the license
        return $this->licenseRepo->update(['uses' => $license->uses + 1], $license);
    }

    /**
     * Builds the required json structure from an intervention
     * @param  Intervention $intervention Intervention used to build from
     * @return JASON                      Structure
     */
    public function buildInterventionJsonStructure($intervention)
    {
        //Upper level of the json file
        $data = [
            'id' => $intervention->id,
            'name' => $intervention->title,
            'content' => [
                'welcome_text' => $intervention->welcome_text,
                'introduction_text' => $intervention->introduction,
                'introduction_text_especific_case' => $intervention->case_introduction,
                'final_text' => $intervention->final_text,
                'sequences' => []
            ],
            'competences' => []
        ];

        //Sequence content of the json file
        foreach ($intervention->sequences as $key => $sequence)
        {
            $data['content']['sequences'][$key] = 
            [
                'id' => $sequence->id,
                'title' => $sequence->title,
                'bg_image' => asset('storage/' . $sequence->background_image_path),
                'description' => $sequence->description,
                'reflexive_text' => $sequence->reflexive_text,
                'video_1' => $sequence->retrieveTransversalVideo()->video_path,
                'video_2' => $sequence->retrieveFunctionalVideo()->video_path,
                'competence' => []
            ];

            $data['content']['sequences'][$key]['competence']['transversals'] = [];
            $data['content']['sequences'][$key]['competence']['functionals'] = [];

            //Foreach competence 
            foreach ($sequence->competences as $secKey => $competence)
            {
                //Transversal competence level
                if ($competence->competence_type_id == 1)
                {
                    $alternativeKeys = [];

                    $alternatives = $sequence->getTransversalAlternativesOrderedByLevel();

                    //Include the alternatives in the json file
                    foreach ($alternatives as $thirdKey => $alternative)
                    {
                        $alternativeKeys[$thirdKey] = 
                        [
                            'id' => $alternative->id,
                            'level' => $alternative->competenceLevel->level,
                            'text' => $alternative->text
                        ];
                    }

                    // $data['content']['sequences'][$key]['competence'][$secKey] =
                    $data['content']['sequences'][$key]['competence']['transversals'][] =
                    [
                        'competence_id' => $competence->id,
                        'type' => $competence->competenceType->label,
                        'functional_category' => null,
                        'question' => $sequence->transversal_question,
                        'alternatives' => array_values($alternativeKeys)
                    ];
                   
                }
                //Functional Competence level
                else
                {
                    foreach ($sequence->functionalCategories as $forthKey => $fcategory)
                    {

                        $alternativeKeys = []; 
                        $alternatives = $fcategory->alternatives;

                        foreach ($alternatives as $thirdKey => $alternative)
                        {
                            $alternativeKeys[$thirdKey] =  [
                                'id' => $alternative->id,
                                'level' => $alternative->competenceLevel->level,
                                'text' => $alternative->text
                            ];
                        }

                        $data['content']['sequences'][$key]['competence']['functionals'][] =
                        [
                            'competence_id' => $competence->id,
                            'type' => $competence->competenceType->label,
                            'functional_category' => $fcategory->label,
                            'question' => $sequence->functional_question,
                            'alternatives' => array_values($alternativeKeys)
                        ];

                    }
                }
            }
        }

        //Retrieve the competences of the intervention
        $competences = $intervention->modelCompetences->competences;

        //Include the competences
        foreach ($competences as $key => $competence)
        {
            $data['competences'][$key] = 
            [
                'id' => $competence->id,
                'name' => $competence->label,
                'levels' => []
            ];

            //Inlclude the comptence levels
            foreach ($competence->levels as $keyLev => $level)
            {
                $data['competences'][$key]['levels'][$keyLev] = 
                [
                    'score' => $level->level,
                    'friendly_description' => $level->amicable_description,
                    'technical_description' => $level->technical_description
                ];
            }
        }

        return $data;
    }

    /**
     * Parses and stores muse raw date stored in a csv file.
     * @param  File               $csvFile            File
     * @param  InterventionResult $interventionResult Belongs to this intervention result
     * @return void                                   Voiduru                     
     */
    public function parseAndStoreFile($csvFile)
    {
        try {
            $rows = \Excel::selectSheetsByIndex(0)->load(
                $csvFile, 
                function($reader) {
                $reader->takeColumns(18);
                $reader->ignoreEmpty();
                $reader->toArray();
            })->get();

            $baseline_rows = 0;
            $baseline_alphasum = 0;
            $baseline_betasum = 0;

            $rows = $rows->toArray();
            $tempArray = array();
            $normalisedArray = array();
            
            foreach($rows as $row) {
                if ($row['activity'] == "PREPARATION") {
                    $baseline_rows+= 1;
                    $baseline_alphasum+= $row['alpha_relative']; 
                    $baseline_betasum+= $row['beta_relative'];
                }

            }
            if ($baseline_alphasum == 0) {
                $baseline_alphasum = 1;
            }

            if ($baseline_betasum == 0) {
                $baseline_betasum = 1;
            }

            $baseline_alpha = round(($baseline_alphasum / $baseline_rows),3);
            $baseline_beta = round(($baseline_betasum / $baseline_rows),3);

            foreach($rows as $row) {
                if ($row['activity'] != "PREPARATION" && $row['activity'] != "ACTIVITY") {
                    $tempArray = array (
                        'competenceid' => $row['competence'],
                        'activity' => $row['activity'],
                        'alphanormalised' => round(((($row['alpha_relative']-$baseline_alpha)/$baseline_alpha)*100),3),
                        'betanormalised' => round(((($row['beta_relative']-$baseline_beta)/$baseline_beta)*100),3)
                    );
                    array_push($normalisedArray,$tempArray);
                }
            }

            $normalisedRows = [];

            foreach ($normalisedArray as $value) {
                if (!isset($normalisedRows[$value['competenceid'].'_'.$value['activity']]['alpha_normalised'])) {
                    $normalisedRows[$value['competenceid'].'_'.$value['activity']]['alpha_normalised'] = $value['alphanormalised'];
                } else {
                    $normalisedRows[$value['competenceid'].'_'.$value['activity']]['alpha_normalised'] += $value['alphanormalised'];
                }

                if (!isset($normalisedRows[$value['competenceid'].'_'.$value['activity']]['beta_normalised'])) {
                    $normalisedRows[$value['competenceid'].'_'.$value['activity']]['beta_normalised'] = $value['betanormalised'];
                } else {
                    $normalisedRows[$value['competenceid'].'_'.$value['activity']]['beta_normalised'] += $value['betanormalised'];
                }

                if (!isset($normalisedRows[$value['competenceid'].'_'.$value['activity']]['alpha_normalised_q'])) {
                    $normalisedRows[$value['competenceid'].'_'.$value['activity']]['alpha_normalised_q'] = 1;
                } else {
                    $normalisedRows[$value['competenceid'].'_'.$value['activity']]['alpha_normalised_q']++;
                }

                if (!isset($normalisedRows[$value['competenceid'].'_'.$value['activity']]['beta_normalised_q'])) {
                    $normalisedRows[$value['competenceid'].'_'.$value['activity']]['beta_normalised_q'] = 1;
                } else {
                    $normalisedRows[$value['competenceid'].'_'.$value['activity']]['beta_normalised_q']++;
                }
            }
        
            foreach ($normalisedRows as $key => $row) {
                if (($row['alpha_normalised'] / $row['alpha_normalised_q']) > ($row['beta_normalised'] / $row['beta_normalised_q'])) {
                    $normalisedRows[$key]['predominant'] = 'Alpha';
                } elseif (($row['alpha_normalised'] / $row['alpha_normalised_q']) == ($row['beta_normalised'] / $row['beta_normalised_q'])) {
                    $normalisedRows[$key]['predominant'] = 'Error';
                } else {
                    $normalisedRows[$key]['predominant'] = 'Beta';
                }
                unset($normalisedRows[$key]['alpha_normalised']);
                unset($normalisedRows[$key]['beta_normalised']);
                unset($normalisedRows[$key]['alpha_normalised_q']);
                unset($normalisedRows[$key]['beta_normalised_q']);
                unset($normalisedRows[$key]['alpha_normalised_d']);
                unset($normalisedRows[$key]['beta_normalised_d']);
            }

            return $normalisedRows;

        } catch (\Exception $e) {
            \App\Entities\Log::create(['name' => 'DATA_CONTENT_FAILURE']);
        }
    }
    
    /**
     * Calculate the percentile for a user
     * @param  Request $request Contains needed parameters
     * @return String           A message indicating which percentile the user is ini
     */
    public function updateAndRetrievePercentile($request)
    {
        //Retroeve tje scpre
        $score = $request['Score'];

        $column = 'r' . $score;

        //Ŕetrieve the needed percentile instance
        $percentile = $this->percentileRepo->where(['intervention_id' => $request['Intervention Id'],
                                                      'competence_id' => $request['Competence Id'],
                                                      'enterprise_id' => $request['Enterprise Id']])
                                           ->first();

        //Update the percentile where the column is the score
        $this->percentileRepo->update([$score => $percentile->$column + 1], $percentile);

        //return the message related to the percentile the user got
        return $percentile->getPercentileScore($score);
    }
}