function handleSuccessCashTable(content){

	clearFormFieldErrors();
	showFormStatusSuccess();
	
	mainRecordName = $('#cashTableCashTableName').val();
	
	updateMainRecordName(mainRecordName, true);
}

function handleFailureCashTable(content){
	
	handleFormFieldError(content, 'cashTable');
}

function openCashTable(){
	
	var cashTableId = $('#cashTableId').val();
	
	showIndicator();
	
	var successFunc = function(content){
		
		hideIndicator();
		
		$('#tab1').html(content);
	}

	var failureFunc = function(t){
		
		hideIndicator();
		
		var cashTableName = $('#cashTableCashTableName').val();
		var content       = t.responseText;
		var errorMessage  = parseMessage(content);
		
		alert('Não foi possível abrir a mesa "'+cashTableName+'"!\n'+(errorMessage?errorMessage:'Por favor, tente novamente.'));
		
		if( isDebug() )
			debug(t.responseText);
	}
	
	var urlAjax = _webRoot+'/cashTable/openTable/cashTableId/'+cashTableId;
	AjaxRequest(urlAjax, {asynchronous:true, evalScripts:false, onFailure:failureFunc, onSuccess:successFunc});
}