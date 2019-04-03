<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Percentile extends Model
{
	protected $fillable = [
	    'r1', 'r2', 'r3', 'r4', 'r5', 'r6', 'r7', 'r8', 'r9', 'r10', 'r11', 'r12', 'r13', 'r14', 'r15', 'r16', 'intervention_id', 'enterprise_id', 'competence_id'
	];

	public function intervention()
	{
		return $this->belongsTo(Intervention::class, 'intervention_id');
	}

	public function enterprise()
	{
		return $this->belongsTo(Enterprise::class, 'enterprise_id');
	}

	public function competence()
	{
		return $this->belongsTo(Competence::class, 'competence_id');
	}

	public function getPercentileScore($score)
	{
		//Get the total number of results
		$total = $this->r1 + $this->r2 + $this->r3 + $this->r4 
			   + $this->r5 + $this->r6 + $this->r7 + $this->r8
			   + $this->r9 + $this->r10 + $this->r11 + $this->r12
			   + $this->r13 + $this->r14 + $this->r15 + $this->r16;

		//if total number is equal to 0 return Na as in no one has taken the test
		if ($total == 0) { return "Na"; } 

		//Initialize count
		$count = 0;

		//Initialize first column
		$column = 'r1';

		//Calculate and return a message if the score is within the 50th percentile
		if ($message = $this->calculatePercentile(0.25, $count, $column, $total, $score))
		{
			return $message;
		}

		//Calculate and return a message if the score is within the 50th percentile
		if ($message = $this->calculatePercentile(0.50, $count, $column, $total, $score))
		{
			return $message;
		}

		//Calculate and return a message if the score is within the 75th percentile
		if ($message = $this->calculatePercentile(0.75, $count, $column, $total, $score))
		{
			return $message;
		}

		//If it is higher than the 75th percentile we just return the best possible result
		return "Máximo";
	}

	/**
	 * Calculate if the given score is witihin a given percentile
	 * @param  Int  $percentile The percentile we are currenlt checking
	 * @param  integer $count      The number of elements already counted
	 * @param  string  $column     The column from the table we are currenlt checking
	 * @param  integer $total      Number of elements in total
	 * @param  integer $score      Score that the user got
	 * @return string              We return a message
	 */
	private function calculatePercentile($percentile, &$count = 0, &$column = 'r1', $total, $score)
	{
		//Set up the correct message for the percentile
		$message = '';

		if ($percentile == 0.25)
		{
			$message = 'Bajo';
		}

		if ($percentile == 0.50)
		{
			$message = 'Medio';
		}

		if ($percentile == 0.75)
		{
			$message = 'Alto';
		}
		//Define the initial column to look into
		$initialColumn = filter_var($column, FILTER_SANITIZE_NUMBER_INT);

		//Obtain the percentile index
		$percentileIndex = $percentile * $total;

		for ($i = $initialColumn; $i < 17; $i++)
		{
			//Check if the percentile is within the actual column
			if ($percentileIndex <= $this->$column + $count)
			{
				//Retrieve the column number
				$columnNumber = filter_var($column, FILTER_SANITIZE_NUMBER_INT);

				//If we are in the last column we just return the best possible percentile situation
				if ($columnNumber == 16)
				{
					return 'Máximo';
				}

				//If the percentile index is an integer
				if (is_int($percentileIndex))
				{
					//check if we are in the upper limit of the column
					if ($percentileIndex == $this->$column + $count)
					{
						//Check if the score is less than the average of the actual column and the next one
						if ($score < ($columnNumber + $columnNumber + 1 )/ 2)
						{
							//If the score is lower we return the adequate message
							return $message;
						}
						//If it isnt we just return null
						else 
						{
							return null;
						}				
					}
					//If we are not in the upper limit 
					else 
					{
						//If the score is lower than the column then we return the appropiate response
						if ($score < $column)
						{
							return $message;
						}
						//If the score isn't lower than the column 
						else
						{
							//update the number of elements counted
							$count += $this->column;

							//we update the column for the next percentile 
							$column = $column[0] . ($i + 1); 

							//We return null
						 	return null;
						}		
					}
				}
				//If the index isnt an integer we need to apply some considerations
				else
				{
					//Check if the rounded up percentile index is greater than the column we are currently in
					if (ceil($percentileIndex) > $this->$column + $count)
					{
						//We need to round the column number up therefore we check the next column
						$columnNumber++;
					}

					//If the score is lower than the column then we return the appropiate message
					if ($score < $columnNumber)
					{
						return $message;
					}
					//If the score isn't lower than the column 
					else
					{
						//update the number of elements counted
						$count += $this->column;

						//we update the column for the next percentile 
						$column = $column[0] . ($i + 1); 

						//We return null
					 	return null;
					}	
				}
			}
			//If the percentile is in a greater column
			else 
			{
				//update the number of elements counted
				$count += $this->$column;
				//Update the actual column being checked
				$column = $column[0] . ($i + 1); 
			}
		}
	}
}
