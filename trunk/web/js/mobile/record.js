function goModule(module, action, fieldName, fieldValue ){
	
	var form    = document.createElement('form');
	form.action = _webRoot+'/'+module+'/'+action
	form.method = 'POST';
	
	var fieldId   = document.createElement('input');
	fieldId.type  = 'hidden';
	fieldId.name  = fieldName;
	fieldId.value = fieldValue;
	
	form.appendChild(fieldId);
	document.body.appendChild(form);
	form.submit();
}