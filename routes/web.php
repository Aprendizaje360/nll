<?php

use App\Http\Repositories\CompetenceRepository;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect(route('admin.home'));
});

Route::get('/sales', function () {
    return redirect(route('enterprise.sales'));
});

Route::get('/home', function(){
	return view('client.home');
});

Auth::routes();

Route::get('/3am', function() {
	try 
	{
		\DB::beginTransaction();
		$competenceRepository = new CompetenceRepository;
		$competences = $competenceRepository->all();

		foreach ($competences as $competence) {
			$totalCompetencesResult = \DB::table('competence_results')->count();
			if ($totalCompetencesResult > 20) {
				$numberPerPart = floor($totalCompetencesResult/4);
				
				$competencesResult = \DB::table('competence_results')
					->select('score')
					->orderBy('score', 'asc')
					->where('competence_id', $competence->id)
					->get();

				\DB::table('perecentil_averages')->update([
					'min' => $competencesResult->forPage(4, $numberPerPart)->min('price'),
					'max' => $competencesResult->forPage(4, $numberPerPart)->max('price'),
				])->where('competence_id', $competence->id)->where('label', 'Excelente');

				\DB::table('perecentil_averages')->update([
					'min' => $competencesResult->forPage(3, $numberPerPart)->min('price'),
					'max' => $competencesResult->forPage(3, $numberPerPart)->max('price'),
				])->where('competence_id', $competence->id)->where('label', 'Bueno');

				\DB::table('perecentil_averages')->update([
					'min' => $competencesResult->forPage(2, $numberPerPart)->min('price'),
					'max' => $competencesResult->forPage(2, $numberPerPart)->max('price'),
				])->where('competence_id', $competence->id)->where('label', 'Regular');

				\DB::table('perecentil_averages')->update([
					'min' => $competencesResult->forPage(1, $numberPerPart)->min('price'),
					'max' => $competencesResult->forPage(1, $numberPerPart)->max('price'),
				])->where('competence_id', $competence->id)->where('label', 'Malo');

			} else {
				if (\DB::table('perecentil_averages')->where('competence_id', $competence->id)->count()) {
					print "Hay menos de 20 datos para competencia ".$competence->id."<br />";
				} else {
					print "Primera vez de la competencia ".$competence->id."<br />";

					\DB::table('perecentil_averages')->insert([
						'competence_id' => $competence->id,
						'label' => 'Excelente',
						'min' => 13,
						'max' => 16,
					]);

					\DB::table('perecentil_averages')->insert([
						'competence_id' => $competence->id,
						'label' => 'Bueno',
						'min' => 10,
						'max' => 12,
					]);

					\DB::table('perecentil_averages')->insert([
						'competence_id' => $competence->id,
						'label' => 'Regular',
						'min' => 7,
						'max' => 9,
					]);

					\DB::table('perecentil_averages')->insert([
						'competence_id' => $competence->id,
						'label' => 'Malo',
						'min' => 4,
						'max' => 6,
					]);
				}
			}
		}
		\DB::commit();
		echo "Base de datos actualizada";
	}
    catch (\Exception $e)
    {
        return response([
            "status"=> "Error interno",
            "message"=> $e->getMessage() . $e->getTraceAsString()
        ], 500);
    }
});



