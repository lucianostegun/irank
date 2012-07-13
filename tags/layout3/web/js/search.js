function loadEventLiveDetails(eventLiveId){
	
	showIndicator();
	
	var successFunc = function(t){
		
		var eventLiveObj = parseInfo(t.responseText);
		
		$('quickEventEventName').innerHTML  = eventLiveObj.eventName;
		$('quickEventWhen').innerHTML       = eventLiveObj.weekDay+', '+eventLiveObj.eventDateTime;
		$('quickEventWhere').innerHTML      = '<b>'+eventLiveObj.clubName+'</b>'+' - '+eventLiveObj.clubLocation;
		$('quickEventRebuys').innerHTML     = eventLiveObj.allowedRebuys;
		$('quickEventAddons').innerHTML     = eventLiveObj.allowedAddons;
		$('quickEventBuyin').innerHTML      = (eventLiveObj.isFreeroll?'Freeroll':(eventLiveObj.entranceFee?eventLiveObj.entranceFee+'+'+eventLiveObj.buyin:eventLiveObj.buyin));
		$('quickEventBlindTime').innerHTML  = eventLiveObj.blindTime;
		$('quickEventStackChips').innerHTML = eventLiveObj.stackChips;
		$('quickEventPlayers').innerHTML    = eventLiveObj.players;
		
		hideIndicator();
		showEventLiveDetails();
	}
	
	var failureFunc = function(t){

		hideIndicator();
		
		alert('Não foi possível obter os detalhes do evento!\nPor favor, tente novamente.');
		
		if( isDebug() )
			debug(content);
	};
	
	var urlAjax = _webRoot+'/eventLive/getInfo/eventLiveId/'+eventLiveId;
	new Ajax.Request(urlAjax, {asynchronous:true, evalScripts:false, onSuccess:successFunc, onFailure:failureFunc});
}

function showEventLiveDetails(){
	
	showDiv('windowLocker');
	showDiv('quickEventLiveDetail');
}

function hideEventLiveDetails(){
	
	hideDiv('windowLocker');
	hideDiv('quickEventLiveDetail');
}