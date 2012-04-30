function goToPage(moduleName, actionName, fieldName, fieldValue, newWindow, evt){
	
	if( evt && (evt.metaKey || evt.altKey) )
		newWindow = true
	
	if( fieldName && fieldValue || newWindow )
		return goModule(moduleName, actionName, fieldName, fieldValue, newWindow );
		
	location.href = _webRoot+'/'+moduleName+'/'+actionName;
}

function doDeleteMain(){
	
	showIndicator();
	
	var moduleName = getModuleName();
	var actionName = 'delete';
	var fieldName  = moduleName+'Id';
	var fieldValue = $('#'+fieldName).val();
	
	var successFunc = function(content){

		hideIndicator();
		goToPage(moduleName, 'index');
	};
		
	var failureFunc = function(t){

		var content = t.responseText;

		var errorMessage = parseMessage(content);

		hideIndicator();
		alert('Não foi possível excluir o evento!\nPor favor, tente novamente.');
		
		if( !errorMessage && isDebug() )
			debug(content);
	};
	
	var urlAjax = _webRoot+'/'+moduleName+'/delete/'+fieldName+'/'+fieldValue;
	AjaxRequest(urlAjax, {asynchronous:true, evalScripts:false, onSuccess:successFunc, onFailure:failureFunc});
}