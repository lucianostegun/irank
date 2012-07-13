function goToPage(moduleName, actionName, fieldName, fieldValue, newWindow, evt){
	
	if( evt && (evt.metaKey || evt.altKey) )
		newWindow = true
	
	if( fieldName && fieldValue || newWindow )
		return goModule(moduleName, actionName, fieldName, fieldValue, newWindow );
		
	location.href = _webRoot+'/'+moduleName+'/'+actionName;
}

function doDeleteMain(){
	
	if( !confirm('Tem certeza que deseja excluir o registro "'+getMainRecordName()+'"?') )
		return false;
	
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
		alert('Não foi possível excluir o registro!'+(errorMessage?errorMessage:'\nPor favor, tente novamente.'));
		
		if( !errorMessage && isDebug() )
			debug(content);
	};
	
	var urlAjax = _webRoot+'/'+moduleName+'/delete/'+fieldName+'/'+fieldValue;
	AjaxRequest(urlAjax, {asynchronous:true, evalScripts:false, onSuccess:successFunc, onFailure:failureFunc});
}