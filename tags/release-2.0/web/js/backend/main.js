var _ModuleName    = null;
var _LockedToolbar = true;

function isReadOnly(){
	
	return _isReadOnly;
}

function setReadOnly( readOnly ){
	
	_isReadOnly = readOnly;
}

function checkIsLogged( content ){

	if( content!='1' )	
		top.location = _webRoot+'/login/logout';
}

function showIndicator( indicatorId ){
	
	indicatorId = (indicatorId?ucfirst(indicatorId):'');
	
	if( !indicatorId ){

		hideDiv('toolbarActionDiv');
		hideDiv('formStatusErrorDiv');
		hideDiv('formStatusSuccessDiv');
		showDiv('indicator');
	}else{
	
		hideDiv('formStatusSuccess'+ucfirst(indicatorId)+'Div');
		hideDiv('formStatusError'+ucfirst(indicatorId)+'Div');
	
		showDiv('indicator'+indicatorId);
		
		if( (buttonBar = $('buttonBar'+ucfirst(indicatorId)))!=null ){
			
			buttonBar.className = buttonBar.className.replace('Error', '');
			buttonBar.className = buttonBar.className.replace('Success', '');
		}
	}
}

function hideIndicator( indicatorId ){
	
	indicatorId = (indicatorId?ucfirst(indicatorId):'');
	
	if( !indicatorId ){

		hideDiv('formStatusErrorDiv');
		hideDiv('formStatusSuccessDiv');
		hideDiv('indicator');
		showDiv('toolbarActionDiv');
	}else{

		hideDiv('indicator'+indicatorId);
	}
}

function goToModule( moduleName, actionName, newWindow ){
	
	if( newWindow )
		window.open( _webRoot+'/'+moduleName+'/'+actionName );
	else
		window.location = _webRoot+'/'+moduleName+'/'+actionName;
}

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

function closeAutoComplete(instanceName, fieldName, fieldSearch ){
	
	hideDiv(instanceName+ucfirst(fieldName)+'FieldDiv');
	showDiv(instanceName+ucfirst(fieldName)+'RoDiv');
	hideDiv(instanceName+ucfirst(fieldName)+'AutoComplete');
}

function toggleButton(buttonId, type){

	buttonId = ucfirst(buttonId);
	
	if( !checkButton(buttonId) )
		return false;
	
	if( type=='over' ){

		$('button'+buttonId+'Left').style.backgroundPosition   = '0 -22';
		$('button'+buttonId+'Middle').style.backgroundPosition = '0 -22';
		$('button'+buttonId+'Right').style.backgroundPosition  = '0 -22';
	}else{
		
		$('button'+buttonId+'Left').style.backgroundPosition   = '0 0';
		$('button'+buttonId+'Middle').style.backgroundPosition = '0 0';
		$('button'+buttonId+'Right').style.backgroundPosition  = '0 0';
	}
}

function showQuickSearchHint(){
	
	hideDiv('taskControlDiv');
	
	if( isVisible('quickSearchHint') )
		hideDiv('quickSearchHint');
	else
		showDiv('quickSearchHint');
}

function adjustTabHeight(){
	
}

function adjustGridboxHeight(){

}

function lockedToolbar(){
	
	return _LockedToolbar;
}

function releaseToolbar(){
	
	_LockedToolbar = false;
}