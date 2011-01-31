function doLogin(){
	
	$('mainForm').onsubmit();
}

function handleLoginSuccess( content ){

	hideIndicator();
	var triedUrl    = $('triedUrl').value;
	
	if( triedUrl )
		window.location = triedUrl;
	else
		window.location = _webRoot+'/home';
}

function handleLoginFailure( content ){

	hideIndicator();
	$('statusMessageDiv').innerHTML = content;

	showDiv('statusMessageDiv');
	
	$('loginBar').style.background          = 'url(/images/backend/login/topBarError.png)';
	$('loginToolbar').style.backgroundColor = '#411810';
}

function cleanLoginErrors(){
	
	hideDiv('statusMessageDiv');
	$('loginBar').style.background          = 'url(/images/backend/login/topBar.png)';
	$('loginToolbar').style.backgroundColor = '#212B2F';
}

function getPasswordRecoveryForm(){

	var successFunc = function(t){

		var content = t.responseText;
		$('retrievePasswordDiv').innerHTML = content;
		hideIndicator();
	};
		
	var failureFunc = function(t){

		var content = t.responseText;
		
		hideIndicator();
	};

	hideDiv('statusMessageDiv');
	showIndicator();	

	var urlAjax = _webRoot+'/login/passwordRetrieveForm';
	new Ajax.Request(urlAjax, {asynchronous:true, evalScripts:false, onSuccess:successFunc, onFailure:failureFunc});
}

function doRetrievePassword(){

	$('passwordRetrieveForm').onsubmit();
}

function handleSuccessPasswordRetrieve( content ){

	$('retrievePasswordDiv').innerHTML = content;
}