<?php

namespace App\Http\Services;

//Repositories
use App\Http\Repositories\VideoRepository;

//Entities

/**
 * Class that handles interaction with the admin repository and other needed logic
 */

class VideoService
{
     protected $videoRepo;

     /**
      * Instantiates the modelCompetencesRepo variable
      * @param ModelCompetencesRepository $modelCompetencesRepo Instance of admin repository
      */
     public function __construct(VideoRepository $videoRepo)
     {
        $this->videoRepo = $videoRepo;
     }

     /**
      * Wizardo storudo
      */
     public function wizardStore($request, $sequence)
     {
        // $path1 = \Storage::putFile('videos', $request->file('video_1'));

        $video1 = $this->videoRepo->create([
                'video_path' => $request->input('video_1')
            ]);

        // $path2 = \Storage::putFile('videos', $request->file('video_2'));

        $video2 = $this->videoRepo->create([
                'video_path' => $request->input('video_2')
            ]);

        $sequence->videos()->attach($video1, ['used_in_transversal' => true]);

        $sequence->videos()->attach($video2);
     }

     //Deletes previous videos and updates the image path
     public function wizardUpdate($request, $sequence)
     {
        $video1 = $sequence->videos[0];

        $video2 = $sequence->videos[1];

        if ($request->has('video_1'))
        {
            // \Storage::disk('local')->delete($video1->video_path);

            // $path = \Storage::putFile('videos', $request->file('video_1'));

            $this->videoRepo->update(['video_path' => $request->input('video_1')], $video1);
        }

        if ($request->has('video_2'))
        {
            // \Storage::disk('local')->delete($video2->video_path);

            // $path = \Storage::putFile('videos', $request->file('video_2'));

            $this->videoRepo->update(['video_path' => $request->input('video_2')], $video2);
        }
     }

    /**
     * Returns all instances of all types of admin
     * @return Collection Collection of admins
     */
    public function all()
    {
    	return $this->VideoRepo->all();
    }


}