function handleSuccessEventLive(content){

	showFormStatusSuccess('eventLive');
	clearFormFieldErrors('eventLive');
	
	mainRecordName = ($('eventLiveEventShortName').value?$('eventLiveEventShortName').value:$('eventLiveEventName').value);
	updateMainRecordName(mainRecordName, true);
}

function handleFailureEventLive(content){
	
	handleFormFieldError(content, 'eventLive');
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