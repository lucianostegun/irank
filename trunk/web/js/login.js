function doQuickLogin(){
	
	$('loginForm').onsubmit();
}

function handleSuccessLogin(content){

	$('loginResumeDiv').innerHTML = content;
	
	loadUserCredit();
}

function loadUserCredit(){
	
	var urlAjax = _webRoot+'/home/getCredit';
	new Ajax.Updater('topMenuDistinct', urlAjax, {asynchronous:true, evalScripts:false});
}

function handleFailureLogin(content){

	enableButton('loginSubmitButton');
	
	if( content.length < 100 )
		$('loginErrorMessage').innerHTML = content;

	showDiv('loginErrorMessage');
}

function doQuickLogout(){
	
	var successFunc = function(t){

		var content = t.responseText;
		
		$('quickLoginContent').innerHTML = content;
	};
		
	var failureFunc = function(t){

		var content = t.responseText;
	};

	var urlAjax = _webRoot+'/login/logout';
	new Ajax.Request(urlAjax, {asynchronous:true, evalScripts:false, onSuccess:successFunc, onFailure:failureFunc});
}

function loadHomeResume(){

	var urlAjax = _webRoot+'/home/resume';
	new Ajax.Updater('homeTopContentDiv', urlAjax, {asynchronous:true, evalScripts:false});
}