console.log('enterprise');

[].forEach.call(document.getElementsByClassName('closeNotification'), function(element) {
	console.log(element);
	element.onclick = function(e){
		e.preventDefault();		
		var id = e.target.dataset.id;
		var notification = document.getElementById(id);
		notification.className += " hidden";
	}
});