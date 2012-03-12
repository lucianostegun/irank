var _SearchEmptyText = null;

function handleMainSearchFocus(fieldObj){
	
	_SearchEmptyText = fieldObj.value;
	
	fieldObj.value = '';
}

function handleMainSearchBlur(fieldObj){
	
	if( fieldObj.value=='' )
		fieldObj.value = _SearchEmptyText;
}

function doQuickSearch(){
	
	if( $('mainSearch').value=='' )
		return false;
	
	$('mainSearchForm').submit();
}

function changeDefaultLanguage(culture){

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

function loadStylesheet(cssPath){

	if( !(/\.css$/i).test(cssPath) )
		cssPath += '.css';
	
	var head  = document.getElementsByTagName('head')[0];
    var link  = document.createElement('link');
    link.rel  = 'stylesheet';
    link.type = 'text/css';
    link.href = cssPath;
    link.media = 'all';
    head.appendChild(link);
}

function goToPage(moduleName, actionName){
	
	location.href = _webRoot+'/'+moduleName+'/'+actionName;
}