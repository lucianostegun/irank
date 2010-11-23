function doLogin(){

	$('mainForm').onsubmit();
}

function handleLoginSuccess( content ){

	hideIndicator();
	window.location = _webRoot+'/home';
}

function handleLoginFailure( content ){

	hideIndicator();
	$('statusMessage').innerHTML = content;
	showDiv('formStatusDiv');
}