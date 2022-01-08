function doSave( formId, mainForm ){

	if( lockedToolbar() ) return false;
	
	if( isReadOnly() )
		return false;
	
	if( mainForm!=false )
		mainForm = true;
	
	if( mainForm )
		defaultSavingToolbar();
		
	var form = $(formId+'Form');
	if( form==null )
		return;
	
	try{ eval('preSave'+ucfirst(getModuleName())+'();') }catch( error ){}

	if( _CtrlKey && isDebug() )
		form.submit();
	else
		form.onsubmit();
}

function doEdit( moduleName ){

	if( $('recordDiv').style.display=='block' ){
	
		eval('openToEdit'+ucfirst(moduleName)+'();');
		return true;
	}
	
	var rowId = gridboxObj.getSelectedId();
	if( !rowId ){
		
		alert('Selecione um registro');
		return false;
	}
	
	var objectId = gridboxObj.cells( rowId, 0 ).getValue();
	
	if( _CtrlKey || _ShiftKey )
		return doOpen(moduleName, 'edit', true, gridboxObj);

	try{ eval('onOpen'+ucfirst(moduleName)+'();') }catch( error ){}
	eval('load'+ucfirst(moduleName)+'('+objectId+', false);');
}

function doView( moduleName ){
	
	if( lockedToolbar() ) return false;
	
	var rowId = gridboxObj.getSelectedId();
	if( !rowId ){
		
		alert('Selecione um registro');
		return false;
	}
	
	var objectId = gridboxObj.cells( rowId, 0 ).getValue();

	if( _CtrlKey || _ShiftKey )
		return doOpen(moduleName, 'view', true, gridboxObj);

	eval('load'+ucfirst(moduleName)+'('+objectId+', true);');
	try{ eval('onOpen'+ucfirst(moduleName)+'();') }catch( error ){}
}

function doOpen( moduleName, actionName, newWindow, gridboxObj ){
	
	if( lockedToolbar() ) return false;
	
	var rowId = gridboxObj.getSelectedId();
	if( !rowId ){
		
		alert('Selecione um registro');
		return false;
	}
	
	var objectId = gridboxObj.cells( rowId, 0 ).getValue();
	
	if( !objectId )
		return false;
	
	var form = document.createElement('form');
	if( newWindow )
		form.target = '_blank';
	
	document.body.appendChild( form );
	
	var fieldNameField   = document.createElement('input');
	fieldNameField.type  = 'hidden';
	fieldNameField.name  = moduleName+'Id';
	fieldNameField.value = objectId;

	form.appendChild( fieldNameField );
	
	form.method = 'POST';
	form.action = _webRoot+'/'+moduleName+'/'+actionName;
	form.submit();
}

function doNew( moduleName ){

	if( lockedToolbar() ) return false;
	
	disableToolbar('new');
	eval('getNew'+ucfirst(moduleName)+'();');
}

function showList(moduleName, refreshGrid){

	if( lockedToolbar() ) return false;
	
	var rowId = gridboxObj.getSelectedId();
	
	disableToolbar('save');
	disableToolbar('index');
	enableToolbar('new');
	
	hideFormStatusError();
	hideFormStatusSuccess();
	clearFormFieldErrors('mainForm');
	
	if( !rowId ){
		
		disableToolbar('delete');
		disableToolbar('view');
		disableToolbar('edit');
	}else{
		
		enableToolbar('view');
		enableToolbar('edit');
		enableToolbar('delete');
	}
	
	if( refreshGrid!==false )
		refreshGrid = true;
	
	closeRecord(moduleName, refreshGrid);
	
	hideDiv('actionDescriptionDiv');
}


function doEditGrid( moduleName, actionName, fieldName, gridboxObj, functionToMultiple ){

	var newWindow = _CtrlKey;
	
	var rowId = gridboxObj.getSelectedId();
	if( !rowId ){
		
		alert('Selecione um registro');
		return false;
	}

	rowIdList = rowId.split(',');
	
	if( functionToMultiple && rowIdList.length > 1 ){

		eval(functionToMultiple);
		return false;
	}else{
		
		rowId = rowIdList[0];
	}
	
	var objectId = gridboxObj.cells( rowId, 0 ).getValue();

	var form = document.createElement('form');
	if( newWindow )
		form.target = '+blank';
	
	document.body.appendChild( form );
	
	var fieldNameField   = document.createElement('input');
	fieldNameField.type  = 'hidden';
	fieldNameField.name  = fieldName;
	fieldNameField.value = objectId;

	form.appendChild( fieldNameField );
	
	form.method = 'POST';
	form.action = _webRoot+'/'+moduleName+'/'+actionName;
	form.submit();
}

function doDelete( moduleName ){

	eval('var fieldName  = "'+moduleName+'Id";');
	
	doDeleteGrid( moduleName, 'delete', fieldName, gridboxObj, null, true )
}

function doDeleteGrid( moduleName, actionName, fieldName, gridboxObj, successFunction, close ){

	var rowId = gridboxObj.getSelectedId();

	if( rowId ){

		var rowIdList = rowId.split(',');
		
		if( isArray( rowIdList ) ){
	
			var objectId = gridboxObj.cells( rowIdList[0], 0 ).getValue();
			
			for(rowId=1; rowId < rowIdList.length; rowId++)
				objectId += ','+gridboxObj.cells( rowIdList[rowId], 0 ).getValue();
		}else{
			
			var objectId = gridboxObj.cells( rowId, 0 ).getValue();
		}
	}else{
		
		var objectId = $(fieldName).value;
	}

	if( !confirm( 'Deseja realmente excluir este registro?' ) )	
		return false;

	var successFunc = function(t) {
		
		var content = t.responseText;
		
		if( rowId )
			gridboxObj.deleteSelectedItem();
		else
			updateGridboxSearch();
		
		if( successFunction )
			successFunction();

		if( close ){
			
			closeRecord(moduleName, false);
			disableToolbarOnIndex();
		}
		
		updatePaginatorCount();
		
		hideIndicator();
		
		hideDiv('actionDescriptionDiv');
	};
		
	var failureFunc = function(t) {

		hideIndicator();
		
		var content = t.responseText;
		var errorDescription = '';
		var showDebug = true;
		
		if( content.charAt(0)=='!' ){

			errorDescription = '\n'+content.replace('!', '');
			showDebug        = false;
		}
		
		alert( 'Não foi possível excluir o registro selecionado!'+errorDescription );
		if( isDebug() && showDebug )
			debug(content);
	};

	showIndicator();	
	
	var urlAjax = _webRoot+'/'+moduleName+'/'+actionName+'/'+fieldName+'/'+ objectId;
	new Ajax.Request(urlAjax, {asynchronous:true, evalScripts:false, onSuccess:successFunc, onFailure:failureFunc});
}

function openModule( moduleName, actionName, gridboxObj ){

	var newWindow = _CtrlKey;
	
	var rowId    = gridboxObj.getSelectedId();
	var objectId = gridboxObj.cells( rowId, 0 ).getValue();

	var form = document.createElement('form');
	if( newWindow )
		form.target = '+blank';
	
	document.body.appendChild( form );
	
	var fieldNameField   = document.createElement('input');
	fieldNameField.type  = 'hidden';
	fieldNameField.name  = moduleName+'Id';
	fieldNameField.value = objectId;

	form.appendChild( fieldNameField );
	
	form.method = 'POST';
	form.action = _webRoot+'/'+moduleName+'/'+actionName;
	form.submit();
}

function openLink( moduleName, actionName, paramList ){
	
	var newWindow = _CtrlKey;
	
	var form = document.createElement('form');
	if( newWindow )
		form.target = '+blank';
	
	document.body.appendChild( form );
	
	if( paramList ){
	
		paramList = paramList.split('&');
		for(var i=0; i < paramList.length; i++){
			
			var paramInfo  = paramList[i].split('=');
			var paramName  = paramInfo[0];
			var paramValue = paramInfo[1];
			
			var fieldNameField   = document.createElement('input');
			fieldNameField.type  = 'hidden';
			fieldNameField.name  = paramName;
			fieldNameField.value = paramValue;
			
			form.appendChild( fieldNameField );
		}
	}
	
	form.method = 'POST';
	form.action = _webRoot+'/'+moduleName+'/'+actionName;
	form.submit();
}






























function openRecord(){
	
	hideDiv('indexDiv');
	showDiv('recordDiv');
	
	hideToolbar('view');
	showToolbar('save');
	showToolbar('index');
	
	showDiv('actionDescriptionDiv');
	
	try{ eval('onOpen'+ucfirst(getModuleName())+'();') }catch( error ){}
	
	adjustTabHeight();
}

function closeRecord(moduleName, refreshGrid){

	changeTitle();
	
	if( refreshGrid=='undefined' )
		refreshGrid = true;
	
	showDiv('indexDiv');
	hideDiv('recordDiv');
	hideDiv('actionDescriptionDiv');
	disableToolbar('index');
	
	showToolbar('view');
	showToolbar('edit');
	hideToolbar('save');
	hideToolbar('index');
	
	document.body.style.background = '#FFFFFF';
	hideFormStatusError();
	hideFormStatusSuccess();

	adjustTabHeight();
	
	if( refreshGrid )
		updateGridboxSearch()

	try{ eval('onClose'+ucfirst(moduleName)+'();') }catch( error ){}
}

function isRecordOpened(){
	
	return ($('recordDiv').style.display == 'block');
}

function isRecordClosed(){
	
	return ($('recordDiv').style.display == 'none');
}

function doExport(exportType){
	
	var instanceName = $('instanceName').value;
	var form         = $(instanceName+'Form');
	var limitTmp     = $(instanceName+'Limit').value;
	var offsetTmp    = $(instanceName+'Offset').value;

//	$(instanceName+'Limit').value  = '';
//	$(instanceName+'Offset').value = '0';
	
	var headerField   = document.createElement('input');
	headerField.type  = 'hidden';
	headerField.name  = 'headerList';
	headerField.value = gridboxObj.hdrLabels;
	form.appendChild(headerField);
	
	form.action = _webRoot+'/'+instanceName+'/getXml/grid/list/exportType/excel';
	form.submit();
	
	form.removeChild(headerField);
	
//	$(instanceName+'Limit').value  = limitTmp;
//	$(instanceName+'Offset').value = offsetTmp;
}