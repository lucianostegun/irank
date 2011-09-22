var _SaveResultAlert  = false;
var _lastFieldValue   = null;
var _SavingInProgress = false;

function handleSuccessEventResult(content){

	_SavingInProgress = false;
	alert(i18n_event_result_successMessage);

	enableButton('mainSubmit');
	hideIndicator('event');
}

function handleFailureEventResult(content){
	
	_SavingInProgress = false;
	enableButton('mainSubmit');

//	handleFormFieldError( request.responseText, 'eventForm', 'event', false, 'event' );
	alert(i18n_event_result_errorMessage);
	hideIndicator('event');
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

function togglePresence(peopleId){
	
	var className = $('eventResultPlayer'+peopleId).className=='confirmed'?'notConfirmed':'confirmed';
	var eventId   = $('eventId').value;
	
	$('eventResultPlayer'+peopleId).className           = className;
	$('eventResultPlayer'+peopleId+'Preview').className = className+'Result';
	
	if( className=='confirmed' )
		$('eventResultPresenceIcon'+peopleId).src = $('eventResultPresenceIcon'+peopleId).src.replace('nok.png', 'ok.png');
	else{
		
		$('eventResultPresenceIcon'+peopleId).src = $('eventResultPresenceIcon'+peopleId).src.replace('/ok.png', '/nok.png');
		
		$('eventPrize'+peopleId).value         = '0,00';
		$('eventEventPosition'+peopleId).value = '0';
		$('eventRebuy'+peopleId).value         = '0,00';
		$('eventAddon'+peopleId).value         = '0,00';
		
		$('eventPrize'+peopleId+'Preview').innerHTML         = '0,00';
		$('eventEventPosition'+peopleId+'Preview').innerHTML = '0';
		$('eventRebuy'+peopleId+'Preview').innerHTML         = '0,00';
		$('eventAddon'+peopleId+'Preview').innerHTML         = '0,00';
	}
	
	var urlAjax = _webRoot+'/event/togglePresence/eventId/'+eventId+'/peopleId/'+peopleId+'/notify/0';
	new Ajax.Request(urlAjax, {asynchronous:true, evalScripts:false});
}

function lunchEventResult(){
	
	$('peopleIdIndex').value = '-1'; 
	
	goTop();
	
	hideDiv('resultDiv');
	showDiv('resultLunchDiv');
	
	getNextResult();
}

function getNextResult(){
	
	getResult(1);
}

function getPreviousResult(){
	
	getResult(-1);
}

function getResult(direction){
	
	var peopleIdIndex = $('peopleIdIndex').value*1+direction;
	var peopleIdList  = $('peopleIdList').value.split(',');
	
	if( peopleIdIndex >= peopleIdList.length )
		peopleIdIndex = 0;
	
	if( peopleIdIndex < 0 )
		peopleIdIndex = peopleIdList.length-1;

	var peopleId = peopleIdList[peopleIdIndex];
	
	$('peopleIdIndex').value = peopleIdIndex;

	var className = $('eventResultPlayer'+peopleId).className;
	
	if( className!='confirmed' )
		return getResult(direction);
	
	$('eventResultLunchPeopleName').innerHTML = $('eventResultPeopleName'+peopleId).innerHTML;

	var buyin    = $('eventBuyin'+peopleId).value;
	var prize    = $('eventPrize'+peopleId).value;
	var position = $('eventEventPosition'+peopleId).value;
	var rebuy    = $('eventRebuy'+peopleId).value;
	var addon    = $('eventAddon'+peopleId).value;
	
	$('eventBuyin').value         = buyin;
	$('eventPrize').value         = prize;
	$('eventEventPosition').value = position;
	$('eventRebuy').value         = rebuy;
	$('eventAddon').value         = addon;
}

function getCurrentResultPeopleId(){

	var peopleIdIndex = $('peopleIdIndex').value*1;
	var peopleIdList  = $('peopleIdList').value.split(',');
	
	return peopleIdList[peopleIdIndex];
}

function replicateValue(fieldObj){

	var fieldId    = fieldObj.id;
	var fieldValue = fieldObj.value;
	
	if( fieldId!='eventEventPosition' )
		fieldValue = toCurrency(fieldObj.value)
	
	fieldId = fieldId+getCurrentResultPeopleId();
	
	$(fieldId).value               = fieldObj.value;
	$(fieldId+'Preview').innerHTML = fieldValue;
}

function toggleView(viewType){

	hideDiv('playerListDiv');
	hideDiv('resultDiv');
	hideDiv('resultLunchDiv');
	hideDiv('resultPreviewDiv');
	hideDiv('commentsDiv');
	hideDiv('infoDiv');
	
	showDiv(viewType+'Div');

	goTop();
}

function previewEventResult(){
	
	toggleView('resultPreview');
}

function doCalculatePrize(){

	var eventId = $('eventId').value;
	
	var totalBuyin = 0;
	var totalPrize = 0;
	var totalRebuy = 0;
	var totalAddon = 0;
	
	var buyin = toFloat($('eventBuyin').value);

	if( !isFreeroll() ){
		
		totalBuyin = toFloat($('eventResultTotalBuyin').innerHTML);
		totalPrize = toFloat($('eventResultTotalPrize').innerHTML);
		totalRebuy = toFloat($('eventResultTotalRebuy').innerHTML);
		totalAddon = toFloat($('eventResultTotalAddon').innerHTML);
	}
	
	var totalBRA = (totalBuyin+totalRebuy+totalAddon);
	
	var buyins = (totalBRA/buyin);
	
	var successFunc = function(t){

		var infoObj = parseInfo(t.responseText);

		var paidPlaces  = infoObj.paidPlaces;
		var percentList = infoObj.percentList.split(',');
		
		
		var peopleIdList = $('resultPeopleIdList').value.split(',');
				
		for(var positionIndex=0; positionIndex < paidPlaces; positionIndex++){

			for(var i=0; i < peopleIdList.length; i++){
				
				var peopleId = peopleIdList[i];
				var position = $('eventEventPosition'+peopleId).value;

				if( position==(positionIndex+1) ){
					
					var percent = percentList[positionIndex];
					
					$('eventPrize'+peopleId).value = toFloat(totalBRA*percent/100, true);
				}
				
				if( position > paidPlaces )
					$('eventPrize'+peopleId).value = toFloat(0, true);
			}
		}
		
		calculateResultTotal('prize');
		
		hideIndicator('eventResult');
	};
		
	var failureFunc = function(t){

		var content = t.responseText;

		alert(i18n_event_calculatePrizeError)

		if( isDebug() )
			debug(content);
		
		hideIndicator('eventResult');
	};
	
	showIndicator('eventResult');
	
	var urlAjax = _webRoot+'/event/getPaidPlaces/eventId/'+eventId+'/buyins/'+buyins;
	new Ajax.Request(urlAjax, {asynchronous:true, evalScripts:false, onSuccess:successFunc, onFailure:failureFunc});
}