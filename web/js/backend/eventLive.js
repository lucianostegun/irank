function handleSuccessEventLive(content){

	showFormStatusSuccess('eventLive');
	clearFormFieldErrors('eventLive');
	
	mainRecordName = ($('eventLiveEventShortName').value?$('eventLiveEventShortName').value:$('eventLiveEventName').value);
	updateMainRecordName(mainRecordName, true);
	
	$('eventLiveResultForm').onsubmit();
}

function handleFailureEventLive(content){
	
	handleFormFieldError(content, 'eventLive');
}

function handleSuccessEventLiveResult(content){
	
	hideIndicator('eventLive');
}

function handleFailureEventLiveResult(content){
	
	hideIndicator('eventLive');
}

function replicateEventName(eventName){
	
	if( $('eventLiveEventShortName').value!='' )
		return;
	
	eventName = eventName.replace(/ ?-.*Garantidos?/, '');
	eventName = eventName.replace(/ ?Garantidos?/, '');
	eventName = eventName.replace(/ ?-.*/, '');
	$('eventLiveEventShortName').value = eventName.substring(0, 35);
}

function handleIsIlimitedRebuys(checked){
	
	$('eventLiveAllowedRebuys').disabled = checked;
}

function handleSelectEventLivePlayer(peopleId, peopleName){

	if( peopleId=='quickNew' )
		addQuickNewPlayer(peopleName)
	else
		addPlayer(peopleId);
}

function addQuickNewPlayer(peopleName){
	
	var successFunc = function(t){

		var peopleId = t.responseText;
		addPlayer(peopleId);
	};
		
	var failureFunc = function(t){

		var content = t.responseText;

		var errorMessage = parseMessage(content);

		alert('Não foi possível adicionar o novo jogador!\nPor favor, tente novamente.');
		
		if( !errorMessage && isDebug() )
			debug(content);
	};
	
	var urlAjax = _webRoot+'/people/addQuickPlayer?peopleName='+peopleName;
	new Ajax.Request(urlAjax, {asynchronous:true, evalScripts:false, onSuccess:successFunc, onFailure:failureFunc});
}

function addPlayer(peopleId){
	
	showIndicator('eventLive');
	
	var eventLiveId = $('eventLiveId').value;
	peopleId        = peopleId.replace(/[^0-9]/gi, '');
	
	var successFunc = function(t){
		
		hideIndicator('eventLive');
		
		var content = t.responseText;
		
		if( content=='noChange' ){
			
			$('eventLivePeopleName').value = 'Jogador já confirmado no evento';
			$('eventLivePeopleName').select();
			window.setTimeout('clearEventLivePeopleName()', 3000);
			return;
		}

		$('eventLivePlayerIdTbody').innerHTML = content;
		$('eventLivePeopleName').value = '';
		$('eventLivePeopleName').focus();
		
		var players = getEventLivePlayers();
		
		$('playerCountDiv').innerHTML       = (players+1)+' Jogador'+(players==0?'':'es')+' confirmado'+(players==0?'':'s');
		$('playerResultCountDiv').innerHTML = (players+1)+' Jogador'+(players==0?'':'es')+' confirmado'+(players==0?'':'s');
	}

	var failureFunc = function(t){
		
		hideIndicator('eventLive');
		
		var errorMessage = parseError(t.responseText);
		errorMessage = (errorMessage?errorMessage:'\nPor favor, tente novamente.');
		
		alert('FALHA NA CONFIRMAÇÃO!\n'+errorMessage);
		
		$('eventLivePeopleName').focus();
		
		if( isDebug() )
			debug(t.responseText);
	}
	
	var urlAjax = _webRoot+'/eventLive/addPlayer/eventLiveId/'+eventLiveId+'/peopleId/'+peopleId;
	new Ajax.Request(urlAjax, {asynchronous:true, evalScripts:false, onFailure:failureFunc, onSuccess:successFunc});	
}

function removePlayer(peopleId){
	
	showIndicator('eventLive');
	
	var eventLiveId = $('eventLiveId').value;
	
	var successFunc = function(t){
		
		var content = t.responseText;
		
		hideDiv('eventLivePeopleIdRow-'+peopleId);
		
		var players = getEventLivePlayers();

		$('playerCountDiv').innerHTML       = (players-1)+' Jogador'+(players==0?'':'es')+' confirmado'+(players==0?'':'s');
		$('playerResultCountDiv').innerHTML = (players-1)+' Jogador'+(players==0?'':'es')+' confirmado'+(players==0?'':'s');
		
		hideIndicator('eventLive');
	}
	
	var failureFunc = function(t){
		
		hideIndicator('eventLive');
		
		var errorMessage = parseError(t.responseText);
		errorMessage = (errorMessage?errorMessage:'\nPor favor, tente novamente.');
		
		alert('Não foi possível remover o jogador do evento!\n'+errorMessage);
		
		if( isDebug() )
			debug(t.responseText);
	}
	
	var urlAjax = _webRoot+'/eventLive/removePlayer/eventLiveId/'+eventLiveId+'/peopleId/'+peopleId;
	new Ajax.Request(urlAjax, {asynchronous:true, evalScripts:false, onFailure:failureFunc, onSuccess:successFunc});	
}

function clearEventLivePeopleName(){
	
	$('eventLivePeopleName').value = '';
	$('eventLivePeopleName').focus();
}

function handleSelectEventLivePlayerResult(peopleId, peopleName, eventPosition){

	peopleId = peopleId.replace(/[^0-9]/gi, '');
	
	setPlayerResult(peopleId, peopleName, eventPosition);
}

function setPlayerResult(peopleId, peopleName, eventPosition){
	
	showIndicator('eventLive');
	
	var eventLiveId = $('eventLiveId').value;
	
	var successFunc = function(t){
		
		var content = t.responseText;
		
		var infoObj = parseInfo(content);
		
		$('eventLivePeopleNameResult-'+eventPosition).value         = infoObj.peopleName;
		$('peopleIdPosition-'+eventPosition).value                  = peopleId;
		$('eventLiveResultEmailAddressTd-'+eventPosition).innerHTML = infoObj.emailAddress;

		if( $('eventLivePeopleNameResult-'+(eventPosition+1))!=null )
			$('eventLivePeopleNameResult-'+(eventPosition+1)).focus();
		
		if( infoObj.eventPositionOld && infoObj.eventPositionOld!=eventPosition ){
			
			var eventPositionOld = infoObj.eventPositionOld

			$('eventLivePeopleNameResult-'+eventPositionOld).value         = '';
			$('peopleIdPosition-'+eventPositionOld).value                  = '';
			$('peopleIdPrize-'+eventPosition).value                        = $('peopleIdPrize-'+eventPositionOld).value;
			$('peopleIdPrize-'+eventPositionOld).value                     = '0,00';
			$('eventLiveResultEmailAddressTd-'+eventPositionOld).innerHTML = '';
		}
		
		hideIndicator('eventLive');
	}
	
	var failureFunc = function(t){
		
		hideIndicator('eventLive');
		
		var errorMessage = parseError(t.responseText);
		errorMessage = (errorMessage?errorMessage:'\nPor favor, tente novamente.');
		
		alert('Não foi possível definir a posição do jogador no evento!\n'+errorMessage);
		
		if( isDebug() )
			debug(t.responseText);
	}
	
	var urlAjax = _webRoot+'/eventLive/savePlayerPosition/eventLiveId/'+eventLiveId+'/peopleId/'+peopleId+'/eventPosition/'+eventPosition;
	new Ajax.Request(urlAjax, {asynchronous:true, evalScripts:false, onFailure:failureFunc, onSuccess:successFunc});
}

function publishEventLiveResult(){
	
	var players = getEventLivePlayers();
	
	for(var eventPosition=1; eventPosition <= players; eventPosition++){
		
		if( $('peopleIdPosition-'+eventPosition)==null || !$('peopleIdPosition-'+eventPosition).value ){
			if( !confirm('ATENÇÃO!\n\nAlgumas posições não foram definidas, deseja realmente continuar?') )
				return;
			
			break;
		}
	}
	
	showIndicator('eventLive');
	
	var successFunc = function(t){
		
		var content = t.responseText;
		
		hideIndicator('eventLive');
	}
	
	var failureFunc = function(t){
		
		hideIndicator('eventLive');
		
		var errorMessage = parseError(t.responseText);
		errorMessage = (errorMessage?errorMessage:'\nPor favor, tente novamente.');
		
		alert('Não foi possível salvar o resultado do evento!\n'+errorMessage);
		
		if( isDebug() )
			debug(t.responseText);
	}
	
	var urlAjax = _webRoot+'/eventLive/savePlayerPosition/eventLiveId/'+eventLiveId+'/peopleId/'+peopleId+'/eventPosition/'+eventPosition;
	new Ajax.Request(urlAjax, {asynchronous:true, evalScripts:false, onFailure:failureFunc, onSuccess:successFunc});
}

function getEventLivePlayers(){

	return $('playerCountDiv').innerHTML.replace(/[^0-9]/ig, '')*1;
}