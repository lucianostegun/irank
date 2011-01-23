var _RecordSaved = null;

function goModule(module, action, fieldName, fieldValue ){
	
	if( isDebug() ){
		
		var urlLocation = _webRoot+'/'+module;
		urlLocation    += (action?'/'+action:'');
		urlLocation    += (fieldName?'/'+fieldName:'');
		urlLocation    += (fieldValue?'/'+fieldValue:'');
		window.location = urlLocation;
	}else{
	
		var form    = document.createElement('form');
		
		var urlLocation = _webRoot+'/'+module;
		urlLocation    += (action?'/'+action:'');
		
		form.action = urlLocation;
		form.method = 'POST';
		
		var fieldId   = document.createElement('input');
		fieldId.type  = 'hidden';
		fieldId.name  = fieldName;
		fieldId.value = fieldValue;
		
		form.appendChild(fieldId);
		document.body.appendChild(form);
		form.submit();
	}
}

function setRecordSaved( value ){
	
	_RecordSaved = value;
}

function isRecordSaved(){
	
	return _RecordSaved;
}

function checkClosingRecord(e) {
	
	if( isRecordSaved()==false ){
	
		if(!e) e = window.event;
		//e.cancelBubble is supported by IE - this will kill the bubbling process.
		e.cancelBubble = true;
		e.returnValue = 'O registro ainda não foi salvo!'; //This is displayed on the dialog
	
		//e.stopPropagation works in Firefox.
		if (e.stopPropagation) {
			e.stopPropagation();
			e.preventDefault();
		}
	}
}

window.onbeforeunload=checkClosingRecord;