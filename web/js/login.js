function doQuickLogin(){
	
	$('loginForm').onsubmit();
}

function handleSuccessLogin(content){

	$('loginResumeDiv').innerHTML = content;

	loadStylesheet('/css/quickResume');
	loadStylesheet('/css/leftMenu');
	
	loadHomeResume();
	loadUserCredit();
}

function loadUserCredit(){
	
	var urlAjax = _webRoot+'/home/getCredit';
	new Ajax.Updater('topMenuDistinct', urlAjax, {asynchronous:true, evalScripts:false});
}

function loadHomeResume(){
	
	showDiv('userResume');
	
	var urlAjax = _webRoot+'/home/getResume';
	new Ajax.Updater('userResume', urlAjax, {asynchronous:true, evalScripts:false});
}

function handleFailureLogin(content){

	enableButton('loginSubmitButton');
	
	if( content.length < 100 )
		$('loginErrorMessage').innerHTML = content;

	showDiv('loginErrorMessage');
}
