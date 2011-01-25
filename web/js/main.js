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

function changeLanguage(culture){

	var handlerFunc = function(t) {
		
		window.location.reload(true);
	};
		
	var errFunc = function(t) {
	
		alert('Erro ao definir o idioma selecionado!\nTente novamente.');
		hideIndicator();
	};
	
	showIndicator();	
	var urlAjax  = _webRoot+'/home/changeLanguage/culture/'+culture;
	new Ajax.Request(urlAjax, {asynchronous:true, evalScripts:false, onSuccess:handlerFunc, onFailure:errFunc});
}