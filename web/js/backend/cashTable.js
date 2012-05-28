var _isRunning          = false;
var _tablePosition      = null;
var currentCashTableObj = {};

$(function() {
	
	statsRunningTime = $('#statsRunningTime').val()*1;
	var tableStatus  = $('#cashTableTableStatus').val();

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
	
	$('#peopleSelectDialog').dialog({
		autoOpen: false,
		modal: true,
		resizable: false,
		width: 550,
		height: 450,
		buttons: {
			Ok: function() {
				doSavePlayer();
			},
			Cancelar: function() {
				closePeopleDialog()
			}
		}
	});
	
	if( tableStatus=='open' )
		$('#cashTableTableTab').mousedown();
});

function handleSuccessCashTable(content){

	clearFormFieldErrors();
	showFormStatusSuccess();
	
	var cashTableObj = parseInfo(content);
	
	mainRecordName = $('#cashTableCashTableName').val();
	
	if( cashTableObj.isOpen ){
		
		$('#cashTableOpenButton').hide();
		$('#cashTableCloseButton').show();
	}else{
	
		$('#cashTableOpenButton').show();
		$('#cashTableCloseButton').hide();
	}
	
	if( !$('#cashTableTableTab').is('visible') )
		$('#cashTableTableTab').show();

	refreshCashTable(cashTableObj.seats);
	
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
//		$('#tab2').html(content);
		
		$('#cashTableTableTab').mousedown();
		
		var cashTableObj = parseInfo(content);
		
		startRunninTimer(true);
		
		$('#dealerButton').attr('class', 'position-'+cashTableObj.dealerStartPosition);
	}

	var failureFunc = function(t){
		
		hideIndicator();
		
		var cashTableName = $('#cashTableCashTableName').val();
		var content       = t.responseText;
		var errorMessage  = parseMessage(content);
		
		alert('Não foi possível abrir a mesa "'+cashTableName+'"!'+(errorMessage?errorMessage:'\nPor favor, tente novamente.'));
		
		if( isDebug() && !errorMessage )
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
		
		stopRunninTimer();
		
		$('#cashTableCloseButton').hide();
		$('#cashTableOpenButton').show();
		$('#tab2').html(content);
		
		loadTabContent('tab1', '/cashTable/getTabContent/tabName/main/cashTableId/'+cashTableId, true)
		hideIndicator();
	}
	
	var failureFunc = function(t){
		
		hideIndicator();
		
		var cashTableName = $('#cashTableCashTableName').val();
		var content       = t.responseText;
		var errorMessage  = parseMessage(content);
		
		alert('Não foi possível fechar a mesa "'+cashTableName+'"!'+(errorMessage?errorMessage:'\nPor favor, tente novamente.'));
		
		if( isDebug() && !errorMessage )
			debug(t.responseText);
	}
	
	var urlAjax = _webRoot+'/cashTable/closeTable/cashTableId/'+cashTableId;
	AjaxRequest(urlAjax, {asynchronous:true, evalScripts:false, onFailure:failureFunc, onSuccess:successFunc});
}

function updatePlayerBankroll(){
	
	var peopleId        = $('#cashTablePeoplePeopleId').val();
	var playerName      = $('#cashTablePeoplePeopleName').val();
	var buyin           = toFloat($('#cashTablePeopleBuyin').val());
	var currentBankroll = toFloat($('#bankroll-'+_tablePosition).html());
	
	$('#seat-'+_tablePosition).removeClass('empty');
	$('#playerName-'+_tablePosition).html(playerName)
	$('#bankroll-'+_tablePosition).html(toCurrency(currentBankroll+buyin));
	currentCashTableObj['tablePosition'+_tablePosition] = {peopleId: peopleId, bankroll: buyin, peopleName: playerName};
}

function updateMainBalance(cashTableObj){
	
	$('#mainBalanceAmount').html(toCurrency(cashTableObj.currentValue));
	$('#statsTotalBuyin').html(toCurrency(cashTableObj.totalBuyin));
	$('#statsTotalEntranceFee').html(toCurrency(cashTableObj.totalEntranceFee));
	$('#statsPlayers').html(cashTableObj.players);
}

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

function refreshCashTable(seats){
	
	var seatHtml = '';
	
	for(var tablePosition=1; tablePosition <= seats; tablePosition++){
		
		seatHtml += '<div class="seat empty" onclick="togglePlayer('+tablePosition+')" id="seat-'+tablePosition+'">';
		seatHtml += '	<label id="playerName-'+tablePosition+'">Vazio</label>';
		seatHtml += '	<span class="bankroll" id="bankroll-'+tablePosition+'">0</span>';
		seatHtml += '	<span class="tablePosition">'+tablePosition+'</span>';
		seatHtml += '</div>';
		
		currentCashTableObj['tablePosition'+tablePosition] = null;
	}

	seatHtml += '<div class="seat dealer empty" onclick="toggleDealer()" id="seat-dealer">';
	seatHtml += '	<label id="dealerName">Vazio</label>';
	seatHtml += '	<span class="tablePosition">dealer</span>';
	seatHtml += '</div>';
	
	currentCashTableObj['dealer'] = null;
	
	$('#cashTableArea').html(seatHtml);
	$('#cashTableArea').attr('class', 'cashTable '+(seats>6?'large':'small'));
}