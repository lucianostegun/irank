var _SaveResultAlert = false;

function handleSuccessEvent(content){

	var infoObj = parseInfo(content);

	updatePlayerContent(infoObj.eventId);
	updateResultContent(infoObj.eventId);
	
	setRecordSaved(true);
	clearFormFieldErrors('eventForm');
	showFormStatusSuccess();
	
	if( $('eventSendEmail')!=null && $('eventSendEmail').checked ){
		
		showDiv('sentEmailDiv');
		$('eventSendEmail').checked = false;
	}

	showButton('confirmPresence');
	showButton('declinePresence');
	showButton('maybePresence');
	
	enableButton('confirmPresence');
	enableButton('declinePresence');
	enableButton('maybePresence');
	
	if( infoObj.inviteStatus=='yes' )   disableButton('confirmPresence');
	if( infoObj.inviteStatus=='no' )    disableButton('declinePresence');
	if( infoObj.inviteStatus=='maybe' ) disableButton('maybePresence');
	
	lockRanking();
	
	adjustContentTab();
	
	enableButton('mainSubmit');
	hideIndicator('event');
}

function handleSuccessEventResult(content){

	clearFormFieldErrors('eventForm');
	showFormStatusSuccess();

	enableButton('mainSubmit');
	hideIndicator('event');
}

function hasResult(){
	
	return $('resultTab')!=null;
}

function doSubmitEvent(content){

	if( !_SaveResultAlert && hasResult() && !confirm('ATENÇÃO!\n\nOs resultados salvos serão enviados por e-mail a todos os convidados e estarão disponíveis para edição até que outro evento posterior seja criado.\n\nDeseja prosseguir?') )
		return false;
	
	_SaveResultAlert = true;
	
	showIndicator('event');
	disableButton('mainSubmit');
	$('eventForm').onsubmit();
}

function chooseMyPresence(choice){
	
	showIndicator('event');
	
	var eventId = $('eventId').value;
	
	var successFunc = function(t){

		var content = t.responseText;

		$('eventPlayerDiv').innerHTML = content;
		
		enableButton('confirmPresence');
		enableButton('declinePresence');
		enableButton('maybePresence');
		
		if( choice=='yes' )   disableButton('confirmPresence');
		if( choice=='no' )    disableButton('declinePresence');
		if( choice=='maybe' ) disableButton('maybePresence');
		
		adjustContentTab();
		
		hideIndicator('event');
	};
		
	var failureFunc = function(t){

		var content = t.responseText;

		hideIndicator('event');
		
		alert('Não foi possível definir sua presença no evento!Tente novamente em alguns instantes.')
		
		if( isDebug() )
			debug(content);
	};
	
	var urlAjax = _webRoot+'/event/choosePresence/eventId/'+eventId+'/choice/'+choice;
	new Ajax.Request(urlAjax, {asynchronous:true, evalScripts:false, onSuccess:successFunc, onFailure:failureFunc});
}

function removePlayer(peopleId){
	
	if( !confirm('Deseja realmente remover este jogador do evento?') )
		return false;
	
	showIndicator('event');
	
	var eventId = $('eventId').value;
	
	var successFunc = function(t){

		var content = t.responseText;
		
		$('eventPlayerDiv').innerHTML = content;

		if( peopleId==_CurrentPeopleId ){
			
			hideButton('confirmPresence');
			hideButton('declinePresence');
			hideButton('maybePresence');
		}
		
		hideIndicator('event');
	};
		
	var failureFunc = function(t){

		var content = t.responseText;

		hideIndicator('event');
		alert('Ocorreu um erro ao remover o jogador do evento!\nTente novamente mais tarde.');
		
		if( isDebug() )
			debug(content);
	};
	
	var urlAjax = _webRoot+'/event/removePlayer/eventId/'+eventId+'/peopleId/'+peopleId;
	new Ajax.Request(urlAjax, {asynchronous:true, evalScripts:false, onSuccess:successFunc, onFailure:failureFunc});
}

function togglePresence(peopleId){
	
	showIndicator('event');
	
	var eventId = $('eventId').value;
	
	var successFunc = function(t){

		if( $('presenceImage'+peopleId).src.match(/(nok|help)\.png$/) ){

			$('presenceImage'+peopleId).src = $('presenceImage'+peopleId).src.replace(/\/(nok|help)\.png$/, '/ok.png');
			
			if( $('eventResultPeopleName'+peopleId)!=null )
				$('eventResultPeopleName'+peopleId).style.color = '';
			
			if( peopleId==_CurrentPeopleId ){

				disableButton('confirmPresence');
				enableButton('declinePresence');
				enableButton('maybePresence');
			}
		}else{

			$('presenceImage'+peopleId).src = $('presenceImage'+peopleId).src.replace(/\/(ok|help)\.png$/, '/nok.png');
			
			if( $('eventResultPeopleName'+peopleId)!=null ){
				
				$('eventResultPeopleName'+peopleId).style.color = '#F5F5F5';

				$('eventEventPosition'+peopleId).value = '0';
				$('eventPrizeValue'+peopleId).value    = '0,00';
				$('eventRebuys'+peopleId).value        = '0';
				$('eventAddons'+peopleId).value        = '0';
			}
			
			if( peopleId==_CurrentPeopleId ){

				enableButton('confirmPresence');
				disableButton('declinePresence');
				enableButton('maybePresence');
			}
		}
		
		hideIndicator('event');
	};
		
	var failureFunc = function(t){

		var content = t.responseText;

		hideIndicator('event');
		alert('Ocorreu um erro ao confirmar a presença!\nTente novamente mais tarde.');
		
		if( isDebug() )
			debug(content);
	};
	
	var notify = $('sendNotify').value;
	
	if( notify=='ask' )
		notify = confirm('Deseja que os convidados sejam notificados?');
	
	notify = (notify=='0'?false:notify);
	
	var urlAjax = _webRoot+'/event/togglePresence/eventId/'+eventId+'/peopleId/'+peopleId+'/notify/'+(notify?'1':'0');
	new Ajax.Request(urlAjax, {asynchronous:true, evalScripts:false, onSuccess:successFunc, onFailure:failureFunc});
}

function lockRanking(){

	if( $('rankinkIdFieldDiv')==null )
		return false;

	var _LockedEvent = true;
	var rankingId   = $('eventRankingId').value
	var rankingName = getSelectText('eventRankingId');

	$('rankinkIdFieldDiv').innerHTML = linkToFunction(rankingName, 'ranking', 'edit', 'rankingId', rankingId);
	$('rankinkIdFieldDiv').className = 'textFlex';
	$('rankinkIdFieldDiv').id        = 'rankinkIdFieldDivOld';
	
	var rankingIdField   = document.createElement('input');
	rankingIdField.type  = 'hidden';
	rankingIdField.name  = 'rankingId';
	rankingIdField.id    = 'eventRankingId';
	rankingIdField.value = rankingId;
	
	$('eventForm').appendChild(rankingIdField);
}

function loadDefaultBuyin(rankingId){
	
	if( $('eventBuyin').value!='0,00' && $('eventBuyin').value!='' )
		return false;
	
	showIndicator('event');
	
	$('eventBuyin').disabled = true;
	
	var successFunc = function(t){

		var content = t.responseText;
		
		$('eventBuyin').disabled = false;
		$('eventBuyin').value    = content;
		
		hideIndicator('event');
	};
		
	var failureFunc = function(t){

		$('eventBuyin').disabled = false;

		hideIndicator('event');
		
		if( isDebug() ){

			var content = t.responseText;
			debug(content);
		}
	};
	
	var urlAjax = _webRoot+'/ranking/getDefaultBuyin/rankingId/'+rankingId;
	new Ajax.Request(urlAjax, {asynchronous:true, evalScripts:false, onSuccess:successFunc, onFailure:failureFunc});	
}

function cloneEvent(eventId){
	
	if( !confirm('Ao clonar um evento você será direcionado para a edição do evento clonado e deverá editar as informações antes de salvar.\n\nDeseja realmente clonar este evento?') )
		return false;
	goModule('event', 'cloneEvent', 'eventId', eventId);
}

function doDeleteEvent(){
	
	if( !confirm('ATENÇÃO!\n\nAo excluir o evento todas as informações de resultados serão perdidas e isso afetará o ranking.\nOs participantes do evento serão notificados da exclusão.\n\n Deseja realmente excluir este evento?') )
		return false;
	
	showIndicator('event');
	
	disableButton('mainSubmit');
	disableButton('confirmPresence');
	disableButton('cancelPresence');
	disableButton('deleteEvent');
	
	var eventId = $('eventId').value;
	
	var successFunc = function(t){

		goModule('event', 'index')
		hideIndicator('event');
	};
		
	var failureFunc = function(t){

		var content = t.responseText;

		hideIndicator('event');
		
		enableButton('mainSubmit');
		enableButton('confirmPresence');
		enableButton('cancelPresence');
		enableButton('deleteEvent');
		
		var errorMessage = parseMessage(content);
		alert('Não foi possível excluir o evento!\n'+(errorMessage?errorMessage:'Tente novamente mais tarde.'));
		
		if( !errorMessage && isDebug() )
			debug(content);
	};
	
	var urlAjax = _webRoot+'/event/delete/eventId/'+eventId;
	new Ajax.Request(urlAjax, {asynchronous:true, evalScripts:false, onSuccess:successFunc, onFailure:failureFunc});
}

function updatePlayerContent(eventId){
	
	var urlAjax = _webRoot+'/event/getPlayerList/eventId/'+eventId;
	new Ajax.Updater('eventPlayerDiv', urlAjax, {asynchronous:true, evalScripts:false});
}

function updateResultContent(eventId){
	
	if( !hasResult() )
		return false;

	var urlAjax = _webRoot+'/event/getResult/eventId/'+eventId;
	new Ajax.Updater('rankingClassifyDiv', urlAjax, {asynchronous:true, evalScripts:false});
}

function doEventSearch(){
	
	var form = $('eventSearchForm');
	if( isIE() ){
		
		$('isIE').value = true;
		form.submit()
		return false;
	}

	var successFunc = function(t){

		var content = t.responseText;
		$('eventListContent').innerHTML = content;
		setButtonLabel('eventFilterSubmit', 'Pesquisar');
	};
		
	var failureFunc = function(t){

		var content = t.responseText;

		setButtonLabel('eventFilterSubmit', 'Pesquisar');
		
		var errorMessage = parseMessage(content);
		alert('Ocorreu um erro ao pesquisar os eventos.'+(errorMessage?'\n'+errorMessage:''));
		
		if( !errorMessage && isDebug() )
			debug(content);
	};
	
	setButtonLabel('eventFilterSubmit', 'Pesquisando', 'ajaxLoader.gif');

	var urlAjax = _webRoot+'/event/search';
	new Ajax.Request(urlAjax, {asynchronous:true, evalScripts:false, onSuccess:successFunc, onFailure:failureFunc, parameters:Form.serialize(form)});
}