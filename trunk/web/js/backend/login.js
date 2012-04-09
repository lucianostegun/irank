function doLogin(){

	hideDiv('loginErrorMessageDiv');
	$('loginForm').onsubmit();
}

function handleSuccessLogin(content){

	$('loginForm').submit();
}

function handleFailureLogin(content){
	
	showDiv('loginErrorMessageDiv');
}
