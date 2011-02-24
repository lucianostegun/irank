function autoScrool(){
	
//	setTimeout(goTop, 100);
}

function goTop(){
	
	window.scrollTo(0, 1)
}

function changeLanguage(culture){

	var handlerFunc = function(t) {
		
		window.location.reload(true);
	};
		
	var errFunc = function(t) {
	
		alert(i18n_changeLanguageError);
		hideIndicator();
	};
	
	showIndicator();	
	var urlAjax  = _webRoot+'/home/changeLanguage/culture/'+culture;
	new Ajax.Request(urlAjax, {asynchronous:true, evalScripts:false, onSuccess:handlerFunc, onFailure:errFunc});
}