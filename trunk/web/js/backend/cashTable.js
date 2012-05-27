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
	
	$('#playerSelectDialog').dialog({
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
				$(this).dialog('close');
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
	
	updateMainRecordName(mainRecordName, true);
}

function handleFailureCashTable(content){
	
	handleFormFieldError(content, 'cashTable');
}

function confirmCashout(){

	if( getSaveAction()=='cashout' ){
		
		var buyin      = toFloat($('#cashTablePeopleBuyin').val());
		var peopleName = $('#playerName-'+_tablePosition).html();
			
		if( !confirm('ATENÇÃO!\n\nConfirma o cashout do jogador '+peopleName+' no valor de R$ '+toCurrency(buyin)+'?') )
			return false;
	}
	
	return true;
}

function doSavePlayer(){

	$('#cashTablePeopleForm').submit()
}

function handleSuccessCashTablePeople(content){
	
	var cashTableObj = parseInfo(content);
	
	if( !cashTableObj ){
		
		alert('Ocorreu um erro ao processar a requisição!\nPor favor, tente novamente.');
		return hideIndicator();
	}
	
	switch( getSaveAction() ){
		case 'seatPlayer':
			seatPlayer(content);
			break;
		case 'seatDealer':
			seatDealer(content);
			break;
		case 'rebuy':
			updatePlayerBankroll();
			break;
		case 'cashout':
			doCashout();
			break;
		default:
			break;
	}
	
	updateMainBalance(cashTableObj);
	closePeopleDialog()
	hideIndicator();
}

function handleFailureCashTablePeople(content){
	
	handleFormFieldError(content, 'cashTablePeople');
}





function openCashTable(){
	
	var cashTableId = $('#cashTableId').val();
	
	showIndicator();
	
	var successFunc = function(content){
		
		hideIndicator();
		
		$('#cashTableOpenButton').hide();
		$('#cashTableCloseButton').show();
		$('#tab2').html(content);
		
		$('#cashTableTableTab').mousedown();
		
		loadTabContent('tab1', '/cashTable/getTabContent/tabName/main/cashTableId/'+cashTableId, true)
		
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
		
		alert('Não foi possível fechar a mesa "'+cashTableName+'"!\n'+(errorMessage?errorMessage:'Por favor, tente novamente.'));
		
		if( isDebug() )
			debug(t.responseText);
	}
	
	var urlAjax = _webRoot+'/cashTable/closeTable/cashTableId/'+cashTableId;
	AjaxRequest(urlAjax, {asynchronous:true, evalScripts:false, onFailure:failureFunc, onSuccess:successFunc});
}

function togglePlayer(tablePosition){
	
	_tablePosition = tablePosition;
	
	clearFormFieldErrors('cashTablePeople');
	var playerInfoObj = currentCashTableObj['tablePosition'+tablePosition];
	
	var isSeatOcupied = playerInfoObj!=null;
	
	if( isSeatOcupied ){
		
		doSelectCashTablePlayer(playerInfoObj.peopleId, playerInfoObj.peopleName, null, true);
		$('#cashTablePeoplePeopleName').hide();
		$('#cashTablePeoplePeopleNameLabel').show();
		
		showPeopleExtraOptions();
	}else{

		$('#cashTablePeoplePeopleNameLabel').hide();
		$('#cashTablePeoplePeopleName').show();
		
		$('#cashTablePeoplePeopleId').val('');
		$('#cashTablePeoplePeopleName').val('');
		$('#cashTablePeopleBuyin').val('');
		$('#cashTablePeopleTablePosition').val(tablePosition);
		
		$('#cashTablePeoplePeopleId').val('');
		$('#cashTablePeoplePeopleNameLabel').html('');
		$('#cashTablePeopleEmailAddress').html('');
		$('#cashTablePeoplePhoneNumber').html('');
		$('#cashTablePeopleLastGame').html('');
		$('#cashTablePeopleRestriction').html('');
		
		showPeopleAddPlayerOptions(tablePosition);
		
		openPeopleDialog();
		
		$('#cashTablePeoplePeopleName').focus();
	}
}

function toggleDealer(){
	
	clearFormFieldErrors('cashTablePeople');
	var dealerInfoObj = currentCashTableObj['dealer'];
	
	var isSeatOcupied = dealerInfoObj!=null;
	
	if( isSeatOcupied ){
		
		doSelectCashTablePlayer(dealerInfoObj.peopleId, dealerInfoObj.peopleName, null, true);
		$('#cashTablePeoplePeopleName').hide();
		$('#cashTablePeoplePeopleNameLabel').show();
		
		showPeopleDealerExtraOptions();
	}else{

		$('#cashTablePeoplePeopleNameLabel').hide();
		$('#cashTablePeoplePeopleName').show();
		
		$('#cashTablePeoplePeopleId').val('');
		$('#cashTablePeoplePeopleName').val('');
		$('#cashTablePeoplePeopleNameLabel').html('');
		$('#cashTablePeopleEmailAddress').html('');
		$('#cashTablePeoplePhoneNumber').html('');
		
		showPeopleDealerOptions();
		
		openPeopleDialog();
		
		$('#cashTablePeoplePeopleName').focus();
	}
}

function doSelectCashTablePlayer(peopleId, peopleName, successFunc, openDialog){
	
	if( peopleId=='quickNew' )
		return addQuickNewPlayer(peopleName, doSelectCashTablePlayer)
	
	$('#cashTablePeoplePeopleId').val(peopleId);
	// carregar aqui as informações do jogador
	
	showIndicator();
	
	var successFunc = function(content){
		
		var peopleObj = parseInfo(content);
		$('#cashTablePeoplePeopleId').val(peopleObj.id);
		$('#cashTablePeoplePeopleName').val(peopleObj.fullName);
		$('#cashTablePeoplePeopleNameLabel').html(peopleObj.fullName);
		$('#cashTablePeopleEmailAddress').html(peopleObj.emailAddress);
		$('#cashTablePeoplePhoneNumber').html(peopleObj.phoneNumber);
		$('#cashTablePeopleLastGame').html(peopleObj.lastGame);
		$('#cashTablePeopleRestriction').html(peopleObj.restriction);
		
		if( openDialog )
			openPeopleDialog()
		else
			$('#cashTablePeopleBuyin').focus();
		
		hideIndicator();
	};
		
	var failureFunc = function(t){

		var content = t.responseText;

		var errorMessage = parseMessage(content);

		addFormError('cashTablePeople', 'peopleName', 'Não foi possível recuperar as informações do jogador');
		
		hideIndicator();
		
		if( !errorMessage && isDebug() )
			debug(content);
	};
	
	var urlAjax = _webRoot+'/people/getPlayerInfo?peopleId='+peopleId;
	AjaxRequest(urlAjax, {asynchronous:true, evalScripts:false, onSuccess:successFunc, onFailure:failureFunc});
}

function updatePlayerBankroll(){
	
	var peopleId        = $('#cashTablePeoplePeopleId').val();
	var playerName      = $('#cashTablePeoplePeopleName').val();
	var buyin           = toFloat($('#cashTablePeopleBuyin').val());
	var currentBankroll = toFloat($('#bankRoll-'+_tablePosition).html());
	
	$('#seat-'+_tablePosition).removeClass('empty');
	$('#playerName-'+_tablePosition).html(playerName)
	$('#bankRoll-'+_tablePosition).html(toCurrency(currentBankroll+buyin));
	currentCashTableObj['tablePosition'+_tablePosition] = {peopleId: peopleId, bankroll: buyin, peopleName: playerName};
}

function doCashout(){
	
	$('#seat-'+_tablePosition).addClass('empty');
	$('#playerName-'+_tablePosition).html('Vazio')
	$('#bankRoll-'+_tablePosition).html('');
	currentCashTableObj['tablePosition'+_tablePosition] = null;
}

function updateMainBalance(cashTableObj){
	
	$('#mainBalanceAmount').html(toCurrency(cashTableObj.currentValue));
	$('#statsTotalBuyin').html(toCurrency(cashTableObj.totalBuyin));
	$('#statsTotalEntranceFee').html(toCurrency(cashTableObj.totalEntranceFee));
	$('#statsPlayers').html(cashTableObj.players);
}

function seatPlayer(){
	
	updatePlayerBankroll();
}

function seatDealer(){
	
	var peopleId        = $('#cashTablePeoplePeopleId').val();
	var playerName      = $('#cashTablePeoplePeopleName').val();
	var buyin           = toFloat($('#cashTablePeopleBuyin').val());
	
	$('#seat-dealer').removeClass('empty');
	$('#dealerName').html(playerName)
	currentCashTableObj['dealer'] = {peopleId: peopleId, peopleName: playerName};
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

function openPeopleDialog(){
	
	$('#playerSelectDialog').dialog('open');
}

function closePeopleDialog(){
	
	$('#playerSelectDialog').dialog('close');
}

function showPeopleAddPlayerOptions(tablePosition){
	
	$('#cashTablePeopleExtraOptionDiv').hide();
	$('#cashTablePeopleCashoutDiv').hide();
	
	$('#cashTablePeopleBuyinDiv').show();
	$('#cashTablePeopleLastGameDiv').show();
	$('#cashTablePeopleRestrictionDiv').show();
	setSaveAction('seatPlayer');
	
	$('#cashTablePeopleBuyin').val('');
	$('#cashTablePeopleBuyin').focus();
	$('#cashTablePeopleBuyinDiv label').first().html('Buyin');
	
	$('#playerSelectDialog').dialog({title:'Inclusão de jogador'});
	$('#playerSelectIntro').html('Informe o nome ou e-mail do jogador que deseja incluir na posição '+tablePosition);
}

function showPeopleExtraOptions(){
	
	$('#cashTablePeopleBuyinDiv').hide();
	$('#cashTablePeopleExtraOptionDiv').show();
	$('#cashTablePeopleLastGameDiv').show();
	$('#cashTablePeopleRestrictionDiv').show();
	
	setSaveAction('');
	
	$('#playerSelectDialog').dialog({title:'Edição de jogador na mesa'});
	$('#playerSelectIntro').html('Escolha uma das opções para gerenciar o jogador na mesa.');
}

function showPeopleRebuyOptions(){
	
	showPeopleAddPlayerOptions();
	
	setSaveAction('rebuy');
	$('#cashTablePeopleBuyinDiv label').first().html('Valor');
	$('#playerSelectDialog').dialog({title:'Recompra'});
	$('#playerSelectIntro').html('Informe o valor da recompra do jogador.');
}

function showPeopleCashoutOptions(){

	showPeopleAddPlayerOptions();

	setSaveAction('cashout');
	$('#cashTablePeopleBuyinDiv label').first().html('Retirada');
	$('#playerSelectDialog').dialog({title:'Saída do jogador'});
	$('#playerSelectIntro').html('Informe o valor de retirada do jogador.');
}

function showPeopleDealerOptions(){
	
	$('#cashTablePeopleExtraOptionDiv').hide();
	$('#cashTablePeopleCashoutDiv').hide();
	$('#cashTablePeopleBuyinDiv').hide();
	$('#cashTablePeopleLastGameDiv').hide();
	$('#cashTablePeopleRestrictionDiv').hide();
	
	setSaveAction('seatDealer');
	
	$('#playerSelectDialog').dialog({title:'Definição do dealer'});
	$('#playerSelectIntro').html('Informe o nome do dealer do jogo');
}

function setSaveAction(saveAction){
	
	$('#cashTablePeopleSaveAction').val(saveAction);
}

function getSaveAction(){
	
	return $('#cashTablePeopleSaveAction').val();
}