function goModule(module, action, fieldName, fieldValue ){
	
	var url = _webRoot+'/'+module+'/'+action;
	if( fieldName )
		url += '/'+fieldName;
	
	if( fieldValue )
		url += '/'+fieldValue;
	
	window.location = url;
}