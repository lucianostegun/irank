function handleSuccessEvent(content){

	clearFormFieldErrors('eventForm');
	showFormStatusSuccess();
	
	if( $('eventSendEmail')!=null && $('eventSendEmail').checked ){
		
		showDiv('sentEmailDiv');
		$('eventSendEmail').checked = false;
	}
	
	if( $('eventConfirmPresence')!=null && $('eventConfirmPresence').checked ){
		
		$('confirmPresenceDiv').className = 'textFlex';
		$('confirmPresenceDiv').innerHTML = 'Presença confirmada';
		
		hideButton('confirmPresence');
		showButton('cancelPresence');
		
		doConfirmPresence(true);
	}
	
	lockRanking();
	
	$('eventMemberDiv').innerHTML = content;

	adjustContentTab();
	
	enableButton('mainSubmit');
	hideIndicator('event');
}

function handleSuccessEventResult(content){

	clearFormFieldErrors('eventForm');
	showFormStatusSuccess();

	$('sendResultMail').checked = false;
	
	enableButton('mainSubmit');
	hideIndicator('event');
}

function doSubmitEvent(content){

	showIndicator('event');
	disableButton('mainSubmit');
	$('eventForm').onsubmit();
}

function doConfirmPresence(supressMessage){
	
	showIndicator('event');
	
	var eventId = $('eventId').value;
	
	var successFunc = function(t){

		var content = t.responseText;
		
		$('eventMemberDiv').innerHTML = content;

		adjustContentTab();
		
		showButton('cancelPresence');
		hideButton('confirmPresence');
		
		hideIndicator('event');
		if( !supressMessage )
			alert('Presença confirmada com sucesso!');
	};
		
	var failureFunc = function(t){

		var content = t.responseText;

		hideIndicator('event');
		
		if( !supressMessage )
			alert('Ocorreu um erro ao confirmar sua presença!\nTente novamente mais tarde.');
		
		if( isDebug() )
			debug(content);
	};
	
	var urlAjax = _webRoot+'/event/addMember/eventId/'+eventId;
	new Ajax.Request(urlAjax, {asynchronous:true, evalScripts:false, onSuccess:successFunc, onFailure:failureFunc});
}

function doCancelPresence(){
	
	if( !confirm('Deseja realmente cancelar a confirmação de sua presença neste evento?') )
		return false;
	
	showIndicator('event');
	
	var eventId = $('eventId').value;
	
	var successFunc = function(t){

		var content = t.responseText;
		
		$('eventMemberDiv').innerHTML = content;
		
		showButton('confirmPresence');
		hideButton('cancelPresence');
		
		hideIndicator('event');
		
		alert('Presença cancelada com sucesso!\nVocê poderá confirmar presença novamente clicando no botão "Confirmar presença".');
	};
		
	var failureFunc = function(t){

		var content = t.responseText;

		hideIndicator('event');
		alert('Ocorreu um erro ao confirmar sua presença!\nTente novamente mais tarde.');
		
		if( isDebug() )
			debug(content);
	};
	
	var urlAjax = _webRoot+'/event/deleteMember/eventId/'+eventId;
	new Ajax.Request(urlAjax, {asynchronous:true, evalScripts:false, onSuccess:successFunc, onFailure:failureFunc});
}

function togglePresence(peopleId){
	
	showIndicator('event');
	
	var eventId = $('eventId').value;
	
	var successFunc = function(t){

		if( $('presenceImage'+peopleId).src.match(/nok\.png/) ){

			$('presenceImage'+peopleId).src = $('presenceImage'+peopleId).src.replace('nok', 'ok');
			
			if( $('eventResultPeopleName'+peopleId)!=null )
				$('eventResultPeopleName'+peopleId).style.color = '';
			
			showButton('cancelPresence');
			hideButton('confirmPresence');
		}else{
			
			$('presenceImage'+peopleId).src = $('presenceImage'+peopleId).src.replace('ok', 'nok');
			
			if( $('eventResultPeopleName'+peopleId)!=null ){
				
				$('eventResultPeopleName'+peopleId).style.color = '#555555';

				$('eventEventPosition'+peopleId).value = '0';
				$('eventPrizeValue'+peopleId).value    = '0,00';
				$('eventRebuys'+peopleId).value        = '0';
				$('eventAddons'+peopleId).value        = '0';
			}
			
			showButton('confirmPresence');
			hideButton('cancelPresence');
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
	
	var urlAjax = _webRoot+'/event/togglePresence/eventId/'+eventId+'/peopleId/'+peopleId;
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