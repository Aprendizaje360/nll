<?php

namespace App\Http\Controllers\Api;

use App\Jobs\ProcessResult;
use Illuminate\Http\Request;

//Services
use App\Http\Controllers\Controller;
use App\Http\Services\Api\InterventionService;

//Entities

//Requests

/**
 * Class that handles api intervention related stuff 
 */
class InterventionController extends Controller
{

	protected $interventionServ;

	/**
	 * Constructor
	 * @param InterventionService $interventionServ Intervention service
	 */
    public function __construct(InterventionService $interventionServ)
    {
    	$this->interventionServ = $interventionServ;
    }

    /**
     * Retrieve Intervention json structure from an id
     * @return  Json Json
     */
    public function getIntervention(Request $request)
    {
    	try
    	{
    		$interventionId = $request['Id'];

	    	$intervention = $this->interventionServ->findIntervention($interventionId);

	    	if (!$intervention)
	    	{
	    		return Response([
	                        'statusCode' => 400,
	                        'message' => 'No se encontro la intervencion'
	                        ], 401);
	    	}

	    	$intervention = $this->interventionServ->buildInterventionJsonStructure($intervention);

	    	return Response([
	                    'statusCode' => 200,
	                    'intervencion' => $intervention,
	                    'message' => 'Se entrego la intervencion'
	                ], 200);
    	}
    	catch  (\Exception $e)
    	{
    		return response([
                "status"=> "Error interno",
                "message"=> $e->getMessage() . $e->getTraceAsString()
            ], 500);
    	}
    }

    /**
     * Receives the results of an interventions. These include a file with muse raw data,
     * the alternatives chosen and the competence score
     * @param  Request $request Contains needed parameters
     * @return Response         Response
     */
    public function postResults(Request $request)    
    {
        try
        {

            $results = json_decode($request->input('results'), true);
            $enterpriseId = $results['IdEmpresa'];
            $userId = $results['IdUsuario'];
            $interventionId = $results['IdIntervencion'];
            $fileName = "results_{$enterpriseId}_{$userId}_{$interventionId}.csv";
            $filePath = \Storage::putFileAs('csvs', $request->file('csv'), $fileName);

            ProcessResult::dispatch($filePath, $results, $this->interventionServ, $userId, $interventionId);

            return response()->json(['success' => true]);

            // \DB::beginTransaction();

            // $csvFile = $request->file('csv');
            // $csvResults = $this->interventionServ->parseAndStoreFile($csvFile);
            // $interventionResult = $this->interventionServ->parseAndStoreResultsData(json_decode($request->input('results'), true), $csvResults);
            // \DB::commit();
            // return response()->json($interventionResult);
        }
        catch (\Exception $e)
        {
            return response([
                "status"=> "Error interno",
                "message"=> $e->getMessage() . $e->getTraceAsString()
            ], 500);
        }
    }

    /**
     * Update and retrieve the percetile the user is in after taking the test
     * @param  Request   $request Contains needed parameters
     * @return Response           Response
     */
    public function updateAndRetrievePercentile(Request $request)
    {
        try
        {
            $message = $this->interventionServ->updateAndRetrievePercentile($request);

            return Response([
                        'statusCode' => 200,
                        'Percentil' => $message,
                        'message' => 'Se actualizo correctamente el percentil'
                    ], 200);
        }
        catch (\Exception $e)
        {
            return response([
                "status"=> "Error interno",
                "message"=> $e->getMessage() . $e->getTraceAsString()
            ], 500);
        }
    }
}
