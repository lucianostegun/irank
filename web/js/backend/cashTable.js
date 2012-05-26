var _isRunning     = false;
var _tablePosition = null;

$(function() {
	
	statsRunningTime = $('#statsRunningTime').val()*1;

	updateRunningTimer = function(){
		
		var seconds = statsRunningTime;
		
		var days = Math.ceil(seconds/86400);
		var hours = Math.ceil(seconds/86400);
		
		days = Math.floor(seconds/86400);
		seconds = seconds - (days*86400);
	
		hours = Math.floor(seconds/3600);
		seconds = seconds - (hours*3600);
	
		minutes = Math.floor(seconds/60);
		seconds = Math.floor(seconds - (minutes*60));
		
		statsRunningTime++;
		
		$('#statsRunningTimeLabel').html(sprintf('%02d\h %02d\m %02d\s', hours, minutes, seconds));
		
		if( _isRunning )
			window.setTimeout('updateRunningTimer()', 1000);
	}
	
	if( statsRunningTime )
		startRunninTimer(false);
	
	
	$('#dialog-message').dialog({
		autoOpen: false,
		modal: true,
		resizable: false,
		width: 550,
		height: 450,
		buttons: {
			Ok: function() {
				addPlayer();
			},
			Cancelar: function() {
				$( this ).dialog('close');
			}
		}
	});
});

function resetRunningTimer(){
	
	statsRunningTime = 0;
}

function startRunninTimer(reset){
	
	if( reset )
		resetRunningTimer();
	
	_isRunning = true;
	updateRunningTimer();
}

function stopRunninTimer(){
	
	_isRunning = false;
}

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
		
		$('#cashTableOpenButton').hide();
		$('#cashTableCloseButton').show();
		$('#tab1').html(content);
		
		startRunninTimer(true);
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

function closeCashTable(){
	
	mainRecordName = $('#cashTableCashTableName').val();
	
	if( !confirm('ATENÇÃO!\n\nTem certeza que deseja fechar a mesa '+mainRecordName+'?') )
		return false;
	
	var cashTableId = $('#cashTableId').val();
	
	showIndicator();
	
	var successFunc = function(content){
		
		hideIndicator();
		
		$('#cashTableCloseButton').hide();
		$('#cashTableOpenButton').show();
		$('#tab1').html(content);
		stopRunninTimer();
	}
	
	var failureFunc = function(t){
		
		hideIndicator();
		
		var cashTableName = $('#cashTableCashTableName').val();
		var content       = t.responseText;
		var errorMessage  = parseMessage(content);
		
		alert('Não foi possível fechar a mesa "'+cashTableName+'"!\n'+(errorMessage?errorMessage:'Por favor, tente novamente.'));
		
		if( isDebug() )
			debug(t.responseText);
	}
	
	var urlAjax = _webRoot+'/cashTable/closeTable/cashTableId/'+cashTableId;
	AjaxRequest(urlAjax, {asynchronous:true, evalScripts:false, onFailure:failureFunc, onSuccess:successFunc});
}

function validatePlayerAdd(){
	
	var peopleId = $('#cashTablePlayerSelectPeopleId').val();
	var buyin    = toFloat($('#cashTablePlayerSelectBuyin').val());
	var buyinMin = toFloat($('#cashTableBuyin').val());
	
	var hasError = false;
	
	clearFormFieldErrors('cashTablePlayerSelect');
	
	if( !peopleId ){
		
		addFormError('cashTablePlayerSelect', 'peopleName', 'Selecione um jogador para adicionar na mesa');
		hasError = true;
	}

	if( !buyin || buyin < buyinMin ){
		
		addFormError('cashTablePlayerSelect', 'buyin', 'Informe um valor maior que '+toCurrency(buyinMin));
		hasError = true;
	}
	
	return !hasError;
}

function addPlayer(){
	
	if( !validatePlayerAdd() )
		return;
	
	var playerName = $('#cashTablePlayerSelectPeopleName').val();
	var buyin      = toFloat($('#cashTablePlayerSelectBuyin').val());
	
	$('#seat-'+_tablePosition).removeClass('empty');
	$('#playerName-'+_tablePosition).html(playerName)
	$('#bankRoll-'+_tablePosition).html(toCurrency(buyin));
	$('#dialog-message').dialog('close');
}