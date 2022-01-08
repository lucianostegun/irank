function doQuickLogin(){

	showIndicator();
	
	disableButton('submitLogin');
	
	var username  = $('loginUsername').value;
	var password  = $('loginPassword').value;
	var keepLogin = $('loginKeepLogin').checked;

	var successFunc = function(t){

		var content = t.responseText;
		
		$('leftBar').innerHTML = content;
		hideDiv('login');

		if( $('homeTopContentDiv')!=null )
			loadHomeResume();
		
		hideIndicator();
	};
		
	var failureFunc = function(t){

		var content = t.responseText;
		
		enableButton('submitLogin');

		showDiv('loginStatus', true);
		hideIndicator();
	};

	var urlAjax = _webRoot+'/login/login/username/'+username+'/password/'+md5(password)+'/keepLogin/'+(keepLogin?'1':'0');
	new Ajax.Request(urlAjax, {asynchronous:true, evalScripts:false, onSuccess:successFunc, onFailure:failureFunc});
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