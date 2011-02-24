var _SaveResultAlert  = false;
var _lastFieldValue   = null;
var _SavingInProgress = false;

function handleSuccessEventResult(content){

	_SavingInProgress = false;
	alert(i18n_event_result_successMessage);

	hideIndicator('event');
}

function handleFailureEventResult(content){
	
	_SavingInProgress = false;
	enableButton('mainSubmit');
	
	handleFormFieldError( request.responseText, 'eventForm', 'event', false, 'event' );
	alert(i18n_event_result_errorMessage);
}

function doSubmitEvent(content){

	if( _SavingInProgress ){
		
		alert(i18n_event_result_waitMessage);
		return false;
	}

	if( !_SaveResultAlert && !confirm(i18n_event_result_saveConfirm) )
		return false;
	
	_SaveResultAlert = true;
	
	showIndicator('event');
	disableButton('mainSubmit');
	_SavingInProgress = true;
	$('eventForm').onsubmit();
}

function handleOnFocus(fieldObj){
	
	var value = fieldObj.value;
	
	_lastFieldValue = value;
	
	if( value.match(/^0([,\.]00)?/) )
		fieldObj.value = '';
}

function handleOnBlur(fieldObj){
	
	var value = fieldObj.value;
	if( value=='' )
		fieldObj.value = _lastFieldValue;
}

function getICalFile(){
	
	var eventId = $('eventId').value;
	
	goModule('event', 'getICal', 'eventId', eventId);
}