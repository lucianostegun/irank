function doSaveMain( formId, evt ){

	formId = (formId?formId:getModuleName());
	
	var form = $(formId+'Form');
	
	if( form==null )
		return;
	
	try{
		eval('var result = preSave'+ucfirst(getModuleName())+'();');

		if( result===false ){
			
			enableButton('toolbarSave');
			return false;
		}
	}catch( error ){
		
	}

	if( (evt.ctrlKey || evt.metaKey) && isDebug() )
		form.submit();
	else
		form.onsubmit();
}

function goToList(evt){
	
	var newWindow = (evt.ctrlKey || evt.metaKey);
	goToPage(getModuleName(), 'index', false, false, newWindow);
}

function goToNew(evt){
	
	var newWindow = (evt.ctrlKey || evt.metaKey);
	goToPage(getModuleName(), 'new', false, false, newWindow);
}



function doDeleteRecords(){
	
	if( !confirm('ATENÇÃO!\n\nDeseja realmente remover os itens selecionados?') )
		return false;
	
	var moduleName = getModuleName();
	
	var successFunc = function(t){

		var content = t.responseText;
		
		if( content ){
			
			var objectIdList = content.split(',');
			
			removeTableRows(moduleName, objectIdList);
		}
		
		hideIndicator(moduleName);
	};
		
	var failureFunc = function(t){

		hideIndicator(moduleName);
		var errorMessage = parseMessage(content);
		
		alert('Não foi possível excluir um ou mais registros selecionados!'+errorMessage);
	};
	
	var urlAjax = _webRoot+'/'+moduleName+'/delete';
	new Ajax.Request(urlAjax, {asynchronous:true, evalScripts:false, onSuccess:successFunc, onFailure:failureFunc, parameters:$(moduleName+'Form').serialize()});
}

function removeTableRows(prefix, objectIdList){
	
	for(var i=0; i < objectIdList.length; i++){
		
		try{
			
			$(prefix+'Tbody').removeChild($(prefix+'IdRow-'+objectIdList[i]));
		}catch(error){
			
			hideDiv(prefix+'IdRow-'+objectIdList[i]);
		}
	}
	
	updatePaginatorRecords(prefix, objectIdList.length);
}

function updateMainRecordName(recordName, updateLastPath){
	
	$('mainRecordName').innerHTML = recordName;
	
	if( updateLastPath )
		updateLastPathName(recordName);
}

function updateLastPathName(recordName){
	
	$('lastPathName').innerHTML = recordName;
}