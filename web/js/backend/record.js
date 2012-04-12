function goToPage(moduleName, actionName, fieldName, fieldValue, newWindow, evt){
	
	if( evt && (evt.metaKey || evt.altKey) )
		newWindow = true
	
	if( fieldName && fieldValue || newWindow )
		return goModule(moduleName, actionName, fieldName, fieldValue, newWindow );
		
	location.href = _webRoot+'/'+moduleName+'/'+actionName;
}