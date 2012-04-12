function selectAutoCompleteItem( id, description, instanceName, fieldName, nextFieldId, options ){
	
	hideDiv(instanceName+ucfirst(fieldName)+'FieldDiv');
	showDiv(instanceName+ucfirst(fieldName)+'RoDiv');
	showDiv(instanceName+ucfirst(fieldName)+'AutoComplete');

	id = id.replace(fieldName, '');

	if( nextFieldId )
		$(nextFieldId).focus();

	if( id=='quickNew' ){
		
		description = description.replace(/.*: /gi, '');
		return addQuickNew(instanceName, fieldName, description, options);
	}

	$(instanceName+ucfirst(fieldName)).value           = id;
	$(instanceName+ucfirst(fieldName)+'Div').innerHTML = description;
}

function openAutoComplete(instanceName, fieldName, fieldSearch, reset ){
	
	showDiv(instanceName+ucfirst(fieldName)+'FieldDiv');
	hideDiv(instanceName+ucfirst(fieldName)+'RoDiv');
	hideDiv(instanceName+ucfirst(fieldName)+'AutoComplete');
	
	if( reset ){
		
		$(instanceName+ucfirst(fieldName)).value = '';
		$(fieldSearch).value                     = '';
	}
	
	$(fieldSearch).focus();
}

function addQuickNew(instanceName, fieldName, quickName, options){
	
	var moduleName = getModuleName();
	
	$(instanceName+ucfirst(fieldName)+'Div').innerHTML = quickName;

	$(moduleName+ucfirst(fieldName)).value = quickName;
	
	var successFunc = function(t){

		var objectId = t.responseText;
		$(instanceName+ucfirst(fieldName)).value = objectId;
	};
		
	var failureFunc = function(t){

		var content = t.responseText;

		var errorMessage = parseMessage(content);

		alert('Não foi possível adicionar o novo registro "'+quickName+'"!\nPor favor, tente novamente.');
		openAutoComplete(instanceName, fieldName, searchFieldName, false )
		
		if( !errorMessage && isDebug() )
			debug(content);
	};
	
	var urlAjax = _webRoot+'/'+options.quickModuleName+'/addQuick/quickName/'+quickName;
	new Ajax.Request(urlAjax, {asynchronous:true, evalScripts:false, onSuccess:successFunc, onFailure:failureFunc});
}