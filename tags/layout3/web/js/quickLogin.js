function doQuickLogin(){
	
	showIndicator();
	hideDiv('loginErrorMessage');
	showDiv('loginIndicator');
	$('quickLoginForm').onsubmit();
}

function handleSuccessQuickLogin(content){

	$('loginResumeDiv').innerHTML = content;
	
	if( getModuleName()=='sign' )
		return goToPage('myAccount', 'index');

	loadHomeResume();
	loadUserCredit();
	hideIndicator();
}

function handleFailureQuickLogin(content){

	enableButton('loginSubmitButton');
	
	if( content.length < 100 )
		$('loginErrorMessage').innerHTML = content;

	showDiv('loginErrorMessage');
	hideDiv('loginIndicator');
	hideIndicator();
}

function loadUserMenu(){
	
	var urlAjax = _webRoot+'/home/getMenu';
	new Ajax.Updater('loginResumeDiv', urlAjax, {asynchronous:true, evalScripts:false});
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