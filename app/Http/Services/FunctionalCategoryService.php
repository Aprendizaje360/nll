<?php

namespace App\Http\Services;

//Repositories
use App\Http\Repositories\FunctionalCategoryRepository;
use App\Http\Repositories\AlternativeRepository;

//Entities
use App\Entities\FunctionalCategory;

/**
 * Class that handles interaction with the FunctionalCategory repository and other needed logic
 */
class FunctionalCategoryService
{
	protected $functionalCategoryRepo;
    protected $alternativeRepo;

    /**
     * Instantiates the FunctionalCategoryRepo variable
     * @param FunctionalCategoryRepository $functionalCategoryRepo Instance of FunctionalCategory repository
     */
    public function __construct(FunctionalCategoryRepository $functionalCategoryRepo,
                                AlternativeRepository $alternativeRepo)
    {
    	$this->functionalCategoryRepo = $functionalCategoryRepo;
        $this->alternativeRepo = $alternativeRepo;
    }

    /**
     * Returns all instances of all types of FunctionalCategory
     * @return Collection Collection of FunctionalCategorys
     */
    public function all()
    {
    	return $this->functionalCategoryRepo->all();
    }

    /**
     * Stores an FunctionalCategory, sets role of FunctionalCategory and sends an email with the FunctionalCategory info 
     * @param  Request $request Attributes for the new FunctionalCategory
     * @return null             Null
     */
    public function store($request)
    {
        $newFunctionalCategory = $this->functionalCategoryRepo->create($request->all()); 
    }

    /**
     * Used to store a functional category when storing a sequence
     * @param  Request $request    contains the parameters
     * @param  Sequence $sequence  Parent sequence
     * @return void                nothing
     */
    public function wizardStore($request, $sequence)
    {
        $fComp = $sequence->retrieveFunctionalCompetence();

        $fFirstLevel = $fComp->levels->where('level', 1)->first();
        $fSecondLevel = $fComp->levels->where('level', 2)->first();
        $fThirdLevel = $fComp->levels->where('level', 3)->first();
        $fFourthLevel = $fComp->levels->where('level', 4)->first();

        for ($index = 1; $index < 5; $index++)
        {
            $fcLabel = $request['functional_category_' . $index];

            $fc = $this->functionalCategoryRepo->create([
                    'label' => $fcLabel,
                    'sequence_id' => $sequence->id
                ]);

            $this->alternativeRepo->create([
                    'text' => $request['functional_alt_level_' . $index . '_1'],
                    'sequence_id' => $sequence->id,
                    'competence_level_id' => $fFirstLevel->id,
                    'level' => 1,
                    'functional_category_id' => $fc->id
                ]);

            $this->alternativeRepo->create([
                    'text' => $request['functional_alt_level_' . $index . '_2'],
                    'sequence_id' => $sequence->id,
                    'competence_level_id' => $fSecondLevel->id,
                    'level' => 2,
                    'functional_category_id' => $fc->id
                ]);

            $this->alternativeRepo->create([
                    'text' => $request['functional_alt_level_' . $index . '_3'],
                    'sequence_id' => $sequence->id,
                    'competence_level_id' => $fThirdLevel->id,
                    'level' => 3,
                    'functional_category_id' => $fc->id 
                ]);

            $this->alternativeRepo->create([
                    'text' => $request['functional_alt_level_' . $index . '_4'],
                    'sequence_id' => $sequence->id,
                    'competence_level_id' => $fFourthLevel->id,
                    'level' => 4,
                    'functional_category_id' => $fc->id 
                ]);    
        }
    }

    /**
     * Used to update the functional categories and the functional alternatives
     * @param  Request  $request  Contains the parameters used to update 
     * @param  Sequence $sequence Parent sequence
     * @return Nothing            Nothing
     */
    public function wizardUpdate($request, $sequence)
    {
        $functionalCategories = $sequence->functionalCategories;

        $fComp = $sequence->retrieveFunctionalCompetence();

        $fFirstLevel = $fComp->levels->where('level', 1)->first();
        $fSecondLevel = $fComp->levels->where('level', 2)->first();
        $fThirdLevel = $fComp->levels->where('level', 3)->first();
        $fFourthLevel = $fComp->levels->where('level', 4)->first();

        foreach ($functionalCategories as $key=>$fc)
        {
            $alternatives = $fc->alternatives;

            $index = $key + 1;

            $fcLabel = $request['functional_category_' . $index];

            $this->functionalCategoryRepo->update([
                    'label' => $fcLabel,
                ], $fc);

            $this->alternativeRepo->update([
                    'text' => $request['functional_alt_level_' . $index . '_1'],
                    'competence_level_id' => $fFirstLevel->id,
                    'level' => 1,
                    'functional_category_id' => $fc->id
                ], $alternatives[0]);

            $this->alternativeRepo->update([
                    'text' => $request['functional_alt_level_' . $index . '_2'],
                    'competence_level_id' => $fSecondLevel->id,
                    'level' => 2,
                    'functional_category_id' => $fc->id
                ], $alternatives[1]);

            $this->alternativeRepo->update([
                    'text' => $request['functional_alt_level_' . $index . '_3'],
                    'competence_level_id' => $fThirdLevel->id,
                    'level' => 3,
                    'functional_category_id' => $fc->id 
                ], $alternatives[2]);

            $this->alternativeRepo->update([
                    'text' => $request['functional_alt_level_' . $index. '_4'],
                    'competence_level_id' => $fFourthLevel->id,
                    'level' => 4,
                    'functional_category_id' => $fc->id 
                ], $alternatives[3]);
        }
    }

    /**
     * Updates an FunctionalCategory
     * @param  Request $request Attributes to be used in the update process
     * @param  FunctionalCategory  $functionalCategory   FunctionalCategory to be updated
     * @return FunctionalCategory          Updated FunctionalCategory
     */
    public function update($request, FunctionalCategory $functionalCategory)
    {       
        return $this->functionalCategoryRepo->update($request->all(), $functionalCategory);
    }

    /**
     * Deletes an FunctionalCategory
     * @param  FunctionalCategory  $functionalCategory FunctionalCategory to be deleted
     * @return int        Row of the deleted FunctionalCategory
     */
    public function delete(FunctionalCategory $functionalCategory)
    {
        return $this->functionalCategoryRepo->delete($functionalCategory->id); 
    }
}