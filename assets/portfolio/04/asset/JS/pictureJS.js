function changeImage(current) {
	var imagesNumber = 4;

	for (i=1; i<=imagesNumber; i++) {
		if (i == current) {
			document.getElementById("pic" + current).style.display = "block";
		} else {
			document.getElementById("pic" + i).style.display = "none";
		}
	}
}


function fadeMe(_ele){
	_ele.style.opacity = 0;

	var alpha = parseFloat( window.getComputedStyle(_ele).opacity );
	
	// If opacity is 100%, fade out
	if( alpha == 1){
		fadeOut(_ele);

	}
	// If opacity is 0%, fade in
	else if( alpha == 0){
		fadeIn(_ele);
	}
}
function fadeOut(_ele){
	var alpha = parseFloat( window.getComputedStyle(_ele).opacity );
	if(alpha >= .05){
		_ele.style.opacity = alpha - .1; 
		
		setTimeout(function () { // anonymous function
			fadeOut(_ele)
		}, 50);
	}
	else{
		_ele.style.opacity = 0;	
	}
}
function fadeIn(_ele){
	var alpha = parseFloat( window.getComputedStyle(_ele).opacity );
	if(alpha <= .95){
		_ele.style.opacity = alpha + .1; 
		
		setTimeout(function () {
			fadeIn(_ele)
		}, 50);
	}
	else{
		_ele.style.opacity = 1;	
	}	
}