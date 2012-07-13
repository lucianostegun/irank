function doLogin(){
	
	showIndicator();
	$('loginForm').onsubmit();
}

function handleSuccessLogin(content){

	goToPage('myAccount', 'index');
}

function handleFailureLogin(content){

	enableButton('loginSubmitButton');
	hideIndicator();
	showDiv('formStatusErrorLoginDiv')
}