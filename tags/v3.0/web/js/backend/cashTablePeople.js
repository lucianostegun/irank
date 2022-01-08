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
		
		if( isDebug() )
			debugAdd(content);
		
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
		case 'cashoutDealer':
			doCashoutDealer();
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






function openPeopleDialog(){
	
	$('#cashTablePeopleCheckInfoDiv').hide();
	$('#cashTablePeoplePayMethodId').val('');
	$.uniform.update();
	
	$('#peopleSelectDialog').dialog('open');
}

function closePeopleDialog(){
	
	$('#peopleSelectDialog').dialog('close');	
}

function setSaveAction(saveAction){
	
	$('#cashTablePeopleSaveAction').val(saveAction);
}

function getSaveAction(){
	
	return $('#cashTablePeopleSaveAction').val();
}






function togglePlayer(tablePosition){
	
	_tablePosition = tablePosition;
	
	clearFormFieldErrors('cashTablePeople');
	var playerInfoObj = currentCashTableObj['tablePosition'+tablePosition];
	
	var isSeatOcupied = playerInfoObj!=null;
	
	if( isSeatOcupied ){
		
		doSelectCashTablePlayer(playerInfoObj.peopleId, playerInfoObj.playerName, null, true);
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
		
		showPeopleSeatPlayerOptions(tablePosition);
		
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
	
	var clubId = $('#cashTableClubId').val();
	
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
		else{
			
			$('#cashTablePeopleBuyin').val('0');
			$('#cashTablePeopleBuyin').focus();
			$('#cashTablePeopleBuyin').select();
		}
		
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
	
	var urlAjax = _webRoot+'/people/getPlayerInfo/peopleId/'+peopleId+'/clubId/'+clubId;
	AjaxRequest(urlAjax, {asynchronous:true, evalScripts:false, onSuccess:successFunc, onFailure:failureFunc});
}







function doCashout(){
	
	$('#seat-'+_tablePosition).addClass('empty');
	$('#playerName-'+_tablePosition).html('Vazio')
	$('#bankroll-'+_tablePosition).html('');
	currentCashTableObj['tablePosition'+_tablePosition] = null;
}

function doCashoutDealer(){
	
	$('#seat-dealer').addClass('empty');
	$('#dealerName').html('Vazio')
	currentCashTableObj['dealer'] = null;
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













function showPeopleSeatPlayerOptions(tablePosition){
	
	$('#cashTablePeopleExtraOptionDiv').hide();
	$('#cashTablePeopleCashoutDiv').hide();
	$('#cashTablePeopleBankrollDiv').hide();
	
	$('#cashTablePeopleBuyinDiv').show();
	$('#cashTablePeoplePayMethodIdDiv').show();
	$('#cashTablePeopleLastGameDiv').show();
	$('#cashTablePeopleRestrictionDiv').show();
	
	
	setSaveAction('seatPlayer');
	
	$('#cashTablePeopleBuyin').val('');
	$('#cashTablePeopleBuyin').focus();
	$('#cashTablePeopleBuyinDiv label').first().html('Buyin');
	
	$('#peopleSelectDialog').dialog({title:'Inclusão de jogador'});
	$('#peopleSelectIntro').html('Informe o nome ou e-mail do jogador que deseja incluir na posição '+tablePosition);
}

function showPeopleExtraOptions(){
	
	$('#cashTablePeopleBuyinDiv').hide();
	$('#cashTablePeoplePayMethodIdDiv').hide();
	$('#cashTablePeopleExtraOptionDiv').show();
	$('#cashTablePeopleLastGameDiv').show();
	$('#cashTablePeopleRestrictionDiv').show();
	$('#cashTablePeopleSelectRebuyLink').show();
	
	var bankrollValue = $('#bankroll-'+_tablePosition).html();
	$('#cashTablePeopleBankroll').html(bankrollValue);
	
	setSaveAction('');
	
	$('#peopleSelectDialog').dialog({title:'Edição de jogador na mesa'});
	$('#peopleSelectIntro').html('Escolha uma das opções para gerenciar o jogador na mesa.');
}

function showPeopleRebuyOptions(){
	
	showPeopleSeatPlayerOptions();
	
	setSaveAction('rebuy');
	$('#cashTablePeopleBuyinDiv label').first().html('Valor');
	$('#peopleSelectDialog').dialog({title:'Recompra'});
	$('#peopleSelectIntro').html('Informe o valor da recompra do jogador.');
}

function showPeopleCashoutOptions(){

	var saveAction = getSaveAction();
	
	if( saveAction=='cashoutDealer' )
		return showDealerCashoutOptions();
	
	showPeopleSeatPlayerOptions();
	
	var bankrollValue = $('#bankroll-'+_tablePosition).html();
	
	$('#cashTablePeopleBankrollDiv').show();
	$('#cashTablePeoplePayMethodIdDiv').hide();
//	$('#cashTablePeopleBuyin').val(bankrollValue);
	$('#cashTablePeopleBuyin').select();

	setSaveAction('cashout');
	
	$('#cashTablePeopleBuyinDiv label').first().html('Retirada');
	$('#peopleSelectDialog').dialog({title:'Saída do jogador'});
	$('#peopleSelectIntro').html('Informe o valor de retirada do jogador.');
}

function showDealerCashoutOptions(){

	showPeopleSeatPlayerOptions();
	
	setSaveAction('cashoutDealer');

	$('#cashTablePeopleBuyinDiv label').first().html('Retirada');
	$('#peopleSelectDialog').dialog({title:'Troca de dealer'});
	$('#peopleSelectIntro').html('Informe o valor de retirada do delaer.');
}

function showPeopleDealerOptions(){
	
	$('#cashTablePeopleExtraOptionDiv').hide();
	$('#cashTablePeopleCashoutDiv').hide();
	$('#cashTablePeopleBankrollDiv').hide();
	$('#cashTablePeopleBuyinDiv').hide();
	$('#cashTablePeoplePayMethodIdDiv').hide();
	$('#cashTablePeopleLastGameDiv').hide();
	$('#cashTablePeopleRestrictionDiv').hide();
	
	setSaveAction('seatDealer');
	
	$('#peopleSelectDialog').dialog({title:'Escolha do dealer'});
	$('#peopleSelectIntro').html('Informe o nome do dealer do jogo');
}

function showPeopleDealerExtraOptions(){
	
	$('#cashTablePeopleBuyinDiv').hide();
	$('#cashTablePeoplePayMethodIdDiv').hide();
	$('#cashTablePeopleBankrollDiv').hide();
	$('#cashTablePeopleLastGameDiv').hide();
	$('#cashTablePeopleRestrictionDiv').hide();
	$('#cashTablePeopleSelectRebuyLink').hide();

	$('#cashTablePeopleExtraOptionDiv').show();
	$('#cashTablePeopleCashoutDiv').show();
	
	setSaveAction('cashoutDealer');
	
	$('#peopleSelectDialog').dialog({title:'Escolha do dealer'});
	$('#peopleSelectIntro').html('Informe o nome do dealer do jogo');
}

function checkPayMethod(payMethodId){
	
	if( payMethodId==payMethodIdCheck || payMethodId==payMethodIdDatedCheck ){
		
		$('#cashTablePeopleCheckNumber').val('');
		$('#cashTablePeopleCheckNominal').val('');
		$('#cashTablePeopleCheckBank').val('');
		$('#cashTablePeopleCheckDate').val('');
		
		if( payMethodId==payMethodIdCheck )
			$('#cashTablePeopleCheckDateDiv').hide();
		else
			$('#cashTablePeopleCheckDateDiv').show();
		
		$('#cashTablePeopleCheckInfoDiv').show();
		$('#cashTablePeopleCheckNumber').focus();
	}else{
	
		$('#cashTablePeopleCheckInfoDiv').hide();
		
		// Define tudo como 1 para que a validação dos campos (que define esses campos como obrigatorios) nao de erro caso a forma de pagamento não seja cheque 
		$('#cashTablePeopleCheckNumber').val('1');
		$('#cashTablePeopleCheckNominal').val('1');
		$('#cashTablePeopleCheckBank').val('1');
		$('#cashTablePeopleCheckDate').val('');
	}
}