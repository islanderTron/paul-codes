function formValidate(){
	errorMsg ="";

	if(document.getElementById("firstName").value.length==0){
		badField(document.getElementById("first"));
		errorMsg += "Type your first name <br/>";

	}
	if(document.getElementById("message").value.length == 0){
		badField(document.getElementById("msg"));
		errorMsg += "Type your message <br/><br/>";
	}
	if(errorMsg){
		errorMsg = "<strong style='color:red;'>Please complete the follow:</strong><br/>" + errorMsg + "<br/>";
		document.getElementById("error-msg").innerHTML=errorMsg;
		return false;
	}
	return true;
}
function badField(_ele){
	_ele.style.color="red";
}