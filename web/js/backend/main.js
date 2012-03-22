function selectAutoCompleteItem( id, description, instanceName, fieldName, nextFieldId ){
	
	hideDiv(instanceName+ucfirst(fieldName)+'FieldDiv');
	showDiv(instanceName+ucfirst(fieldName)+'RoDiv');
	showDiv(instanceName+ucfirst(fieldName)+'AutoComplete');

	id = id.replace(fieldName, '');
	
	$(instanceName+ucfirst(fieldName)).value           = id;
	$(instanceName+ucfirst(fieldName)+'Div').innerHTML = description;

	if( nextFieldId )
		$(nextFieldId).focus();
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