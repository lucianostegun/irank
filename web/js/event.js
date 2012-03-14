var _SaveResultAlert = false;

function handleErrorEvent(content){
	
	alert(i18n_event_save_error)
	
	enableButton('mainSubmit');
	hideIndicator('event');
	
	if( isDebug() )
		debug(content);
	
	return false;
}

function handleSuccessEvent(content){

	var eventObj = parseInfo(content);

	if( eventObj==null )
		return handleErrorEvent(content);
	
	var pastDate = eventObj.pastDate;
	
	$('eventId').value = eventObj.eventId;
	
	setLastBarPath(eventObj.eventName);

	updatePlayerContent(eventObj.eventId, pastDate);
	
	if( pastDate )
		updateResultContent(eventObj.eventId);
	
	setRecordSaved(true);
	setButtonBarStatus('eventMain', 'success');
	clearFormFieldErrors('eventForm');
	showFormStatusSuccess();
	
	if( $('eventSendEmail')!=null && $('eventSendEmail').checked ){
		
		showDiv('sentEmailDiv');
		$('eventSendEmail').checked = false;
	}

	if( pastDate ){
		
		lockEvent(eventObj.id)
		
		hideButton('confirmPresence');
		hideButton('declinePresence');
		hideButton('maybePresence');
		
		hideButton('mainSubmit');
		showButton('mainSubmitResult');
		
		disableButton('confirmPresence');
		disableButton('declinePresence');
		disableButton('maybePresence');

		$('eventPrizeConfig').value = eventObj.prizeConfig;
		
		hideDiv('mainMenuEventAddRankingPlayersDiv');
		hideDiv('mainMenuEventImportPlayersDiv');
		
		loadEventResultWindowContent(eventObj.id);
	}else{
		
		showButton('confirmPresence');
		showButton('declinePresence');
		showButton('maybePresence');
		
		enableButton('confirmPresence');
		enableButton('declinePresence');
		enableButton('maybePresence');
		
		lockRanking();
	}
	
	showDiv('mainMenuEvent');
	
	if( eventObj.inviteStatus=='yes' )   disableButton('confirmPresence');
	if( eventObj.inviteStatus=='no' )    disableButton('declinePresence');
	if( eventObj.inviteStatus=='maybe' ) disableButton('maybePresence');
	
	tabBarMainObj.showTab('comments');
	tabBarMainObj.showTab('player');
	
	if( pastDate )
		tabBarMainObj.showTab('result');
	
	adjustContentTab();
	
	enableButton('mainSubmit');
	hideIndicator('event');
}

function handleFailureEvent(content){
	
	enableButton('mainSubmit');
	setButtonBarStatus('eventMain', 'error');
	handleFormFieldError(content, 'eventForm', 'event', false, 'event', handleErrorEvent)
}

function handleSuccessEventResult(content){

	var eventId = $('eventId').value;
	
	setButtonBarStatus('eventMain', 'success');
	clearFormFieldErrors('eventResultForm');
	showFormStatusSuccess();
	
	windowEventResultHide();
	
	updateResultContent(eventId);

	enableButton('eventResultSubmit');
	enableButton('calculatePrize');
	showButton('facebookResultResult');
	hideIndicator('eventResult');
}

function hasResult(){
	
	return $('resultTab')!=null;
}

function doSubmitEvent(content){

	disableButton('mainSubmit');
	
	if( !_SaveResultAlert && hasResult() && !confirm(i18n_event_saveResultConfirm) ){
		
		enableButton('mainSubmit');
		return false;
	}
	
	_SaveResultAlert = true;
	
	showIndicator('event');
	$('eventForm').onsubmit();
}

function doSubmitEventResult(content){
	
	disableButton('eventResultSubmit');
	disableButton('calculatePrize');
	
	if( !_SaveResultAlert && hasResult() && !confirm(i18n_event_saveResultConfirm) ){
		
		enableButton('eventResultSubmit');
		enableButton('calculatePrize');
		return false;
	}
	
	_SaveResultAlert = true;
	
	showIndicator('eventResult');
	$('eventResultForm').onsubmit();
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
		
		alert(i18n_event_saveMyPresenceError)
		
		if( isDebug() )
			debug(content);
	};
	
	var urlAjax = _webRoot+'/event/choosePresence/eventId/'+eventId+'/choice/'+choice;
	new Ajax.Request(urlAjax, {asynchronous:true, evalScripts:false, onSuccess:successFunc, onFailure:failureFunc});
}

function removePlayer(peopleId){
	
	if( !confirm(i18n_event_playersTab_playerDeleteConfirm) )
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
		
		var errorMessage = parseMessage(content);
		alert(i18n_event_playersTab_playerDeleteError+'\n'+(errorMessage?errorMessage:i18n_tryAgain));
		
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
				$('eventPrize'+peopleId).value         = i18n_zero_zeroZero;
				$('eventRebuy'+peopleId).value         = '0';
				$('eventAddon'+peopleId).value         = '0';
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
		alert(i18n_event_playersTab_togglePresenceError);
		
		if( isDebug() )
			debug(content);
	};
	
	var notify = $('sendNotify').value;
	
	if( notify=='ask' )
		notify = confirm(i18n_event_playersTab_presenceNotifyConfirm);
	
	notify = (notify=='0'?false:notify);
	
	var urlAjax = _webRoot+'/event/togglePresence/eventId/'+eventId+'/peopleId/'+peopleId+'/notify/'+(notify?'1':'0');
	new Ajax.Request(urlAjax, {asynchronous:true, evalScripts:false, onSuccess:successFunc, onFailure:failureFunc});
}

function togglePresenceResult(peopleId){
	
	if( $('presenceImage'+peopleId).src.match(/(nok|help)\.png$/) ){

		$('presenceImage'+peopleId).src = $('presenceImage'+peopleId).src.replace(/\/(nok|help)\.png$/, '/ok.png');
		
		$('eventResultPeopleName'+peopleId).style.color = '';
		
		if( $('eventResultPeopleName'+peopleId)!=null )
			showDiv('eventResultRow'+peopleId, false, 'table-row');
	}else{

		$('presenceImage'+peopleId).src = $('presenceImage'+peopleId).src.replace(/\/(ok|help)\.png$/, '/nok.png');
		
		if( $('eventResultPeopleName'+peopleId)!=null ){
			
			$('eventBuyin'+peopleId).value         = '0';
			$('eventEventPosition'+peopleId).value = '0';
			
			if( isFreeroll() ){
				
				$('eventPrize'+peopleId+'Div').innerHTML = i18n_zero_zeroZero;
			}else{
				
				$('eventPrize'+peopleId).value         = i18n_zero_zeroZero;
				$('eventRebuy'+peopleId).value        = '0';
				$('eventAddon'+peopleId).value        = '0';
			}
			
			hideDiv('eventResultRow'+peopleId);
		}
	}
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

function handleRankingChoice(rankingId){
	
	showIndicator('event');
	
	$('eventBuyin').disabled = true;
	
	var successFunc = function(t){

		var content    = t.responseText;
		var rankingObj = parseInfo(content);

		$('eventBuyin').disabled = false;
		
		if( $('eventBuyin').value==i18n_zero_zeroZero || $('eventBuyin').value=='' )
			$('eventBuyin').value = toCurrency(rankingObj.defaultBuyin);
		
		if( rankingObj.gameStyleTag=='ring' ){
			
			toggleFreerollFields(false);
			hideDiv('eventIsFreerollField');
			hideDiv('eventIsFreerollLabel');
			hideDiv('eventIsFreerollError');
		}else{
		
			showDiv('eventIsFreerollField');
			showDiv('eventIsFreerollLabel');
		}
		
		$('eventRankingAvailableCredit').innerHTML = toCurrency(rankingObj.credit);
		
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
	
	var urlAjax = _webRoot+'/ranking/getInfo/rankingId/'+rankingId;
	new Ajax.Request(urlAjax, {asynchronous:true, evalScripts:false, onSuccess:successFunc, onFailure:failureFunc});	
}

function loadRankingPlaceList(rankingId, rankingPlaceId){
	
	var onchangeFunc = $('eventRankingPlaceId').onchange;
	$('eventRankingPlaceIdDiv').innerHTML = getWaitSelect();
	
	var successFunc = function(t){
		
		var content = t.responseText;
		
		$('eventRankingPlaceIdDiv').innerHTML = content;
		$('eventRankingPlaceId').onchange     = onchangeFunc;
	};
	
	var failureFunc = function(t){
		
		alert(i18n_event_mainTab_rankingPlaceLoadingError);
		$('eventRankingPlaceIdDiv').innerHTML = getEmptySelect;
		
		if( isDebug() ){
			
			var content = t.responseText;
			debug(content);
		}
	};
	
	var urlAjax = _webRoot+'/event/getRankingPlaceList/rankingId/'+rankingId+'/rankingPlaceId/'+rankingPlaceId;
	new Ajax.Request(urlAjax, {asynchronous:true, evalScripts:false, onSuccess:successFunc, onFailure:failureFunc});	
}

function checkRankingPlace(rankingPlaceId){
	
	var rankingId = $('eventRankingId').value;
	
	if( rankingPlaceId=='new' ){
		
		_RankingPlaceSuccessFunc = function(rankingPlaceId){ loadRankingPlaceList(rankingId, rankingPlaceId); }
		addRankingPlace(rankingId);
	}
}

function cloneEvent(){
	
	if( !confirm(i18n_event_cloneConfirm) )
		return false;
	
	var eventId = $('eventId').value;
	
	goModule('event', 'cloneEvent', 'eventId', eventId);
}

function doDeleteEvent(){
	
	if( !confirm(i18n_event_deleteConfirm) )
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
		alert(i18n_event_deleteError+'\n'+(errorMessage?errorMessage:i18n_tryAgain));
		
		if( !errorMessage && isDebug() )
			debug(content);
	};
	
	var urlAjax = _webRoot+'/event/delete/eventId/'+eventId;
	new Ajax.Request(urlAjax, {asynchronous:true, evalScripts:false, onSuccess:successFunc, onFailure:failureFunc});
}

function updatePlayerContent(eventId, pastEvent){
	
	var urlAjax = _webRoot+'/event/getPlayerList/eventId/'+eventId;
	new Ajax.Updater((pastEvent?'mainPlayerObjDiv':'eventPlayerDiv'), urlAjax, {asynchronous:true, evalScripts:false});
	
	var urlAjax = _webRoot+'/event/getPlayerList/eventId/'+eventId+'/result/1';
	new Ajax.Updater('eventResultPlayerListDiv', urlAjax, {asynchronous:true, evalScripts:false});
}

function updateResultContent(eventId){

	if( !hasResult() )
		return false;
	
	var successFunc = function(t){

		$('eventResultDiv').innerHTML = t.responseText;
		adjustContentTab();
	}
	
	var urlAjax = _webRoot+'/event/getResult/eventId/'+eventId+'/readOnly/1';
	new Ajax.Request(urlAjax, {asynchronous:true, evalScripts:false, onSuccess:successFunc});

	if( $('eventResultTableDiv')!=null ){
		
		var urlAjax = _webRoot+'/event/getResult/eventId/'+eventId;
		new Ajax.Updater('eventResultTableDiv', urlAjax, {asynchronous:true, evalScripts:false});
	}
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
		hideIndicator();
	};
		
	var failureFunc = function(t){

		var content = t.responseText;

		hideIndicator();
		
		var errorMessage = parseMessage(content);
		alert(i18n_event_searchError+(errorMessage?'\n'+errorMessage:''));
		
		if( !errorMessage && isDebug() )
			debug(content);
	};
	
	showIndicator();

	var urlAjax = _webRoot+'/event/search';
	new Ajax.Request(urlAjax, {asynchronous:true, evalScripts:false, onSuccess:successFunc, onFailure:failureFunc, parameters:Form.serialize(form)});
}

function toggleEventShare(peopleId){
	
	showIndicator('eventPlayerList');
	
	var eventId = $('eventId').value;
	
	var successFunc = function(t){

		var content = t.responseText;
		
		if( content=='lock' ){
			
			$('eventShare'+peopleId).src   = $('eventShare'+peopleId).src.replace('lock', 'unlock');
			$('eventShare'+peopleId).title = $('eventShare'+peopleId).title.replace(i18n_enable, i18n_disable);
		}else{
			
			$('eventShare'+peopleId).src   = $('eventShare'+peopleId).src.replace('unlock', 'lock');
			$('eventShare'+peopleId).title = $('eventShare'+peopleId).title.replace(i18n_disable, i18n_enable);
		}
		
		hideIndicator('eventPlayerList');
	};
		
	var failureFunc = function(t){

		var content = t.responseText;

		alert(i18n_event_playersTab_shareError)
		hideIndicator('eventPlayerList');
		
		if( isDebug() )
			debug(content);
	};
	
	var urlAjax = _webRoot+'/event/toggleShare/eventId/'+eventId+'/peopleId/'+peopleId;
	new Ajax.Request(urlAjax, {asynchronous:true, evalScripts:false, onSuccess:successFunc, onFailure:failureFunc});
}

function handleOnFocus(fieldObj){
	
	var value = fieldObj.value;
	if( value.match(/^0(,00)?/) )
		fieldObj.value = '';
}

function handleOnBlur(fieldObj){
	
	var value = fieldObj.value;
	if( value=='' )
		if( fieldObj.maxLength > 5 )
			fieldObj.value = i18n_zero_zeroZero;
		else
			fieldObj.value = '0';
}

function onSelectTabEvent(tabId){

	showDiv('actionBarDiv');
	
	switch( tabId ){
		case 'comments':
			hideDiv('actionBarDiv');
			break;
	}
	
	return true;
}

function handleOnFocus(fieldObj){

	var value = fieldObj.value;
	
	_lastFieldValue = value;
	
	if( value.match(/^0(,00)?/) )
		fieldObj.value = '';
}

function handleOnBlur(fieldObj){
	
	var value = fieldObj.value;
	if( value=='' )
		fieldObj.value = _lastFieldValue;
}

function importPlayers(){

	if( !confirm(i18n_event_players_importConfirm) )
		return false;
	
	showIndicator('event');
	
	var eventId = $('eventId').value;
	
	var successFunc = function(t){

		var content = t.responseText;
		
		updatePlayerContent(eventId);
		updateResultContent(eventId);
		
		tabBarMainObj.setTabActive('player');
		alert(i18n_event_players_importSuccess);
		
		hideIndicator('event');
	};
		
	var failureFunc = function(t){

		var content = t.responseText;

		alert(content)
		hideIndicator('event');
		
		if( isDebug() )
			debug(content);
	};
	
	var urlAjax = _webRoot+'/event/importPlayers/eventId/'+eventId;
	new Ajax.Request(urlAjax, {asynchronous:true, evalScripts:false, onSuccess:successFunc, onFailure:failureFunc});
}

function handleSuccessEventRankingPlayer(content){
	
	$('rankingPlayerForm').reset();
	
	var eventId = $('eventId').value;

	updatePlayerContent(eventId);
	updateResultContent(eventId);
	
	enableButton('rankingPlayerSubmit');
	
	hideIndicator('rankingPlayer');
	
	adjustContentTab();
	windowRankingPlayerAddHide();
}

function getICalFile(){
	
	var eventId = $('eventId').value;
	
	goModule('event', 'getICal', 'eventId', eventId);
}

function calculateResultTotal(type){
	
	var peopleIdList = $('resultPeopleIdList').value.split(',');
	var totalValue   = 0;
	
	for(var i=0; i < peopleIdList.length; i++){
		
		var peopleId = peopleIdList[i];
		value = $('event'+ucfirst(type)+peopleId).value;
		value = toFloat(value);
		
		totalValue += value;
		
		if( isFreeroll() && (type=='rebuy' || type=='addon') )
			calculateFreerollPrize(peopleId)
	}
	
	$('eventResultTotal'+ucfirst(type)).innerHTML = toFloat(totalValue, true);
	
	if( isFreeroll() ){

		for(var i=0; i < peopleIdList.length; i++){
			
			var peopleId = peopleIdList[i];
			
			if( type=='rebuy' || type=='addon' )
				calculateFreerollPrize(peopleId)
		}
	}else{
		
		checkTotalPrize();
	}
}

function checkTotalPrize(){
	
	var totalBuyin = toFloat($('eventResultTotalBuyin').innerHTML);
	var totalPrize = 0;
	var totalRebuy = 0;
	var totalAddon = 0;
	
	if( !isFreeroll() ){
		
		totalPrize = toFloat($('eventResultTotalPrize').innerHTML);
		
		if( $('eventResultTotalRebuy')!=null )
			totalRebuy = toFloat($('eventResultTotalRebuy').innerHTML);
		
		if( $('eventResultTotalAddon')!=null )
			totalAddon = toFloat($('eventResultTotalAddon').innerHTML);
	}
	
	if( totalPrize!=(totalBuyin+totalRebuy+totalAddon) )
		$('eventResultTotalPrize').style.color = '#FF0000';
	else
		$('eventResultTotalPrize').style.color = '';
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
		
		if( $('eventResultTotalRebuy')!=null )
			totalRebuy = toFloat($('eventResultTotalRebuy').innerHTML);
		
		if( $('eventResultTotalAddon')!=null )
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

function calculateFreerollPrize(peopleId){
	
	var prizePot        = toFloat($('eventPrizePot').value);
	var prizeConfig     = ';'+$('eventPrizeConfig').value;
	var prizeConfigList = prizeConfig.split(';');
	
	var eventPosition = $('eventEventPosition'+peopleId).value;
	eventPosition *= 1;
	
	if( eventPosition < prizeConfigList.length){
		
		var prizeValue = prizeConfigList[eventPosition];
		var isPercent  = prizeValue.match(/[0-9]%$/);
		prizeValue     = toFloat(prizeValue);
		
		if( isPercent ){
			
			var totalRebuy = 0;
			var totalAddon = 0;
			
			if( $('eventResultTotalRebuy')!=null )
				totalRebuy = toFloat($('eventResultTotalRebuy').innerHTML);
			
			if( $('eventResultTotalAddon')!=null )
				totalAddon = toFloat($('eventResultTotalAddon').innerHTML);
			
			var totalBRA = (prizePot+totalRebuy+totalAddon);
			
			prizeValue = toFloat(totalBRA*prizeValue/100);
		}
	}else
		var prizeValue = 0;
	
	$('eventPrize'+peopleId).value           = toCurrency(prizeValue);
	$('eventPrize'+peopleId+'Div').innerHTML = toCurrency(prizeValue);
	
	calculateResultTotal('prize');
}

function checkBuyin(peopleId){
	
	if( isFreeroll() )
		return calculateFreerollPrize(peopleId);
	
	var eventPosition = $('eventEventPosition'+peopleId).value;
	
	if( !eventPosition || eventPosition=='0' ){
		
		$('eventBuyin'+peopleId).value = '0';
		
		if( !isRing(peopleId) )
			$('eventResultBuyin'+peopleId).innerHTML = '0,00';
	}else{
	
		$('eventBuyin'+peopleId).value = $('eventBuyin').value;
		
		if( !isRing(peopleId) )
			$('eventResultBuyin'+peopleId).innerHTML = $('eventBuyin').value;
	}
	
	calculateResultTotal('buyin');
}

function isRing(peopleId){
	
	return ($('eventBuyin'+peopleId).type=='text');
}

function toggleBuyin(peopleId){
	
	if( isFreeroll() )
		return true;
	
	var eventPosition = $('eventEventPosition'+peopleId).value;
	var eventBuyin    = $('eventBuyin').value;

	if( eventPosition && (eventPosition*1) > 0 ){

		$('eventBuyin'+peopleId).value = eventBuyin;
		
		if( !isRing(peopleId) )
			$('eventResultBuyin'+peopleId).innerHTML = toFloat(eventBuyin, true);
	}else
		$('eventBuyin'+peopleId).value = '0,00';
}

function isFreeroll(){
	
	return ($('isFreeroll').value=='1');
}

function openEventResult(){
	
	enableButton('eventResultSubmit');

	if( isFreeroll() )
		hideButton('calculatePrize');
	else
		enableButton('calculatePrize');
	
	windowEventResultShow();
}

function toggleEventResultView(showResult){
	
	if( showResult ){
	
		hideDiv('eventResultPlayerListDiv');
		showDiv('eventResultTableDiv');
		showButton('toggleResultButtonPlayer');
		showButton('eventResultSubmit');
		hideButton('toggleResultButtonResult');
		
		if( !isFreeroll() )
			showButton('calculatePrize');
	}else{

		showDiv('eventResultPlayerListDiv');
		hideDiv('eventResultTableDiv');
		hideButton('toggleResultButtonPlayer');
		hideButton('eventResultSubmit');
		showButton('toggleResultButtonResult');
		hideButton('calculatePrize');
	}
}

function loadEventResultWindowContent(eventId){
	
	if( $('windowEventResultDiv').innerHTML!='' )
		return false;
	
	var urlAjax = _webRoot+'/event/getResultWindow/eventId/'+eventId;
	new Ajax.Updater('windowEventResultDiv', urlAjax, {asynchronous:true, evalScripts:false});
}

function lockEvent(eventId){

	var urlAjax = _webRoot+'/event/getMainTab/eventId/'+eventId+'/readOnly/1';
	new Ajax.Updater('mainMainObjDiv', urlAjax, {asynchronous:true, evalScripts:false});
}

function shareFacebook(eventId){

	var urlShare = _webRoot+'/event/facebookShareUrl/eventId/'+eventId;
	window.open(urlShare,'irankFacebookShare', 'toolbar=0, status=0, width=650, height=450');
}

function toggleFreerollFields(checked){
	
	if( checked ){
		
		hideDiv('eventEntranceFeeRow');
		hideDiv('eventBuyinRow');
		showDiv('eventFreerollLinkDiv');
		$('eventEntranceFee').value = '0,00';
		$('eventBuyin').value       = '0,00';
		$('isFreeroll').value       = '1';
	}else{
		
		showDiv('eventEntranceFeeRow');
		showDiv('eventBuyinRow');
		hideDiv('prizeConfigDiv');
		hideDiv('eventFreerollLinkDiv');
		$('eventPrizePot').value = '0,00';
		
		$('eventPaidPlaces').readOnly  = false;
		$('eventPaidPlaces').className = '';
		$('eventHasShare').value       = '';
		$('isFreeroll').value          = '';
	}
	
	$('eventIsFreeroll').checked = checked;
}

function configurePrize(){
	
	var paidPlaces = $('eventPaidPlaces').value;
	
	if( !paidPlaces.match(/^[0-9]+$/) ){
		
		alert(i18n_event_paidPlacesFormatError);
		return false;
	}
	
	$('eventPaidPlaces').readOnly  = true;
	$('eventPaidPlaces').className = 'disabled';
	
	showDiv('prizeConfigDiv');
	
	html = '';
		
	for(var i=1; i <= paidPlaces; i++){
		
		html += '<div class="row">';
		html += '	<div class="label">'+i+getOrdinalSufix(i)+' '+i18n_event_place+'</div>';
		html += '	<div class="field"><input type="text" autocomplete="off" name="paidPlace'+i+'" id="eventPaidPlace'+i+'" value="0,00" size="5" maxlength="6" onkeyup="maskCurrency(event)" style="text-align: right" /></div>';
		html += '</div>';
	}
	
	$('prizeShareListDiv').innerHTML = html;
	$('eventHasShare').value         = '1';
	adjustContentTab();
}