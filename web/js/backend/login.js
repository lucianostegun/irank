function doLogin(){

	hideDiv('loginErrorMessageDiv');
	$('loginForm').onsubmit();
}

function handleSuccessLogin(content){

	window.location = _webRoot+'/home';
}

function handleFailureLogin(content){

	showDiv('loginErrorMessageDiv');
}
