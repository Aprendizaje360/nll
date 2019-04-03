//categoriesObj gets build using Blade on the template
//it has all the categoryTypes and subcategories so we can create the second select field dinamicaly
function transversalLevelChange()
{
	let competenceId = transversalSelector.options[transversalSelector.selectedIndex].value;
	axios({
			method: 'GET',
			headers: {'X-Requested-With': 'XMLHttpRequest',
					'X-CSRF-Token': document.csrf_token,
			},
			url:`http://${document.location.host}/admin/competences/${competenceId}/levels`

	}).then(response => {	
		console.log(response);

		for (let i = 0; i < response.data.levels.length; i++)
		{
			let level = response.data.levels[i];
			let index = i + 1;
			var trans_description= document.getElementById('trans_description_m_' + index);
			trans_description.value = level.technical_description;

			trans_description = document.getElementById('trans_description_h_' + index);
			trans_description.value = level.amicable_description;
		}

	}).catch(error => {
		console.log(error);
	});
}

function functionalLevelChange()
{
	// get current subcategories
	let competenceId = functionalSelector.options[functionalSelector.selectedIndex].value;
	axios({
			method: 'GET',
			headers: {'X-Requested-With': 'XMLHttpRequest',
					'X-CSRF-Token': document.csrf_token,
			},
			url:`http://${document.location.host}/admin/competences/${competenceId}/levels`

	}).then(response => {	
		console.log(response);

		for (let i = 0; i < response.data.levels.length; i++)
		{
			let level = response.data.levels[i];
			let index = i +1;
			var func_descriptions= document.querySelectorAll('.func_description_m_' + index);
			func_descriptions.forEach((func_description) => {
				func_description.value = level.technical_description;
			});

			func_descriptions = document.querySelectorAll('.func_description_h_' + index);
			func_descriptions.forEach((func_description) => {
				func_description.value = level.amicable_description;
			});
		}
	}).catch(error => {
		console.log(error);

	});
}

const transversalSelector = document.getElementById("transversalSelect");

transversalSelector.addEventListener('change', transversalLevelChange);

const functionalSelector = document.getElementById("functionalSelect");

functionalSelector.addEventListener('change', functionalLevelChange);

transversalLevelChange();
functionalLevelChange();