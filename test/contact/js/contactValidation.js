function validateForm(){
	var errorMsg = "";

	var name = document.getElementById('name').value;
	var email = document.getElementById('email').value;
	var comment = document.getElementById('comment').value;

	// Name
	if( name.length == ""){
		errorMsg += ("Name cannot be blank</br>");
	}
	// Email
	if(!(email.match(/^[a-zA-Z]+([_\.-]?[a-zA-Z0-9]+)*@[a-zA-Z0-9]+([\.-]?[a-zA-Z0-9]+)*(\.[a-zA-Z]{2,4})+$/ ))){
		errorMsg += ("Email is incorrect<br/>");
	}
	// Comment
	if(comment.length == ""){
		errorMsg += ("Your message cannot be blank");
	}
	// Check if we get erros message and then display them
	if(errorMsg){
		errorMsg = "<p>Please complete the following on the list:</p>"+errorMsg;
		document.getElementById("error-msg").innerHTML= errorMsg;
		return false;
	}
	else{
		swal("Contact Form Send", "Paul Uncangco will contact you soon", "success");
	}
}