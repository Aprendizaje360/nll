<?php 

if (!function_exists('slugify')) {

	function slugify($string)
	{
		// replace spaces
		$slugified = str_replace([' '],"-",strtolower($string));

		// treat spanish characters accordingly
		$spanish_chars = [
			"á"=> "a",
			"é"=> "e",
			"í"=> "i",
			"ó"=> "o",
			"ú"=> "u",
			"ü"=> "u",
			"ñ"=> "n"
		];

		foreach ($spanish_chars as $original => $new) {
			$slugified = str_replace($original, $new, $slugified);
		}

		
   		// Removes special chars.
   		$slugified = preg_replace('/[^A-Za-z0-9\-]/', '', $slugified); 

   		// Replaces multiple hyphens with single one.
   		$slugified = preg_replace('/-+/', '-', $slugified); 

   		// removes last remaining - in case it exists (for example ! or ? symbols at the end)
		return rtrim($slugified, '-');
	}
}
