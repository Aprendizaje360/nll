console.log('addClerks');

document.getElementById('addClerk').onclick = function(e){
	var element = document.getElementById("modal");
	element.classList.add("modal--show");
}

document.getElementById('cancel').onclick = function(e){
	e.preventDefault();
	var element = document.getElementById("modal");
	element.classList.remove("modal--show");
}