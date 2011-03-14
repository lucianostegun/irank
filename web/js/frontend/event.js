var _SaveResultAlert = false;

function handleSuccessEvent(content){

	var eventObj = parseInfo(content);
	
	$('eventId').value = eventObj.eventId;

	updatePlayerContent(eventObj.eventId);
	
	if( eventObj.pastDate )
		updateResultContent(eventObj.eventId);
	
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
	
	showDiv('mainMenuEvent');
	
	if( eventObj.inviteStatus=='yes' )   disableButton('confirmPresence');
	if( eventObj.inviteStatus=='no' )    disableButton('declinePresence');
	if( eventObj.inviteStatus=='maybe' ) disableButton('maybePresence');
	
	tabBarMainObj.showTab('comments');
	tabBarMainObj.showTab('player');
	
	if( eventObj.pastDate )
		tabBarMainObj.showTab('result');
	
	lockRanking();
	
	adjustContentTab();
	
	enableButton('mainSubmit');
	hideIndicator('event');
}

function handleSuccessEventResult(content){

	var eventId = $('eventId').value;
	
	clearFormFieldErrors('eventResultForm');
	showFormStatusSuccess();
	
	windowEventResultHide();
	
	updateResultContent(eventId);

	enableButton('eventResultSubmit');
	enableButton('calculatePrize');
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
			$('eventPrize'+peopleId).value         = i18n_zero_zeroZero;
			$('eventRebuy'+peopleId).value        = '0';
			$('eventAddon'+peopleId).value        = '0';
			
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

function loadDefaultBuyin(rankingId){
	
	if( $('eventBuyin').value!=i18n_zero_zeroZero && $('eventBuyin').value!='' )
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

function updatePlayerContent(eventId){
	
	var urlAjax = _webRoot+'/event/getPlayerList/eventId/'+eventId;
	new Ajax.Updater('eventPlayerDiv', urlAjax, {asynchronous:true, evalScripts:false});
}

function updateResultContent(eventId){

	if( !hasResult() )
		return false;
	
	var successFunc = function(t){
	
		$('eventResultDiv').innerHTML = t.responseText;
		adjustContentTab();
	}
	
	var urlAjax = _webRoot+'/event/getResult/eventId/'+eventId;
	new Ajax.Request(urlAjax, {asynchronous:true, evalScripts:false, onSuccess:successFunc});
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
		alert(i18n_event_players_importSuccess)
		
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
		
		value = $('event'+ucfirst(type)+peopleIdList[i]).value;
		value = toFloat(value);
		
		totalValue += value;
	}
	
	$('eventResultTotal'+ucfirst(type)).innerHTML = toFloat(totalValue, true);
	checkTotalPrize();
}

function checkTotalPrize(){
	
	var totalBuyin = toFloat($('eventResultTotalBuyin').innerHTML);
	var totalPrize = toFloat($('eventResultTotalPrize').innerHTML);
	var totalRebuy = toFloat($('eventResultTotalRebuy').innerHTML);
	var totalAddon = toFloat($('eventResultTotalAddon').innerHTML);
	
	if( totalPrize!=(totalBuyin+totalRebuy+totalAddon) )
		$('eventResultTotalPrize').style.color = '#FF0000';
	else
		$('eventResultTotalPrize').style.color = '';
}

function doCalculatePrize(){

	var eventId = $('eventId').value;
	
	var buyin      = toFloat($('eventBuyin').value);
	var totalBuyin = toFloat($('eventResultTotalBuyin').innerHTML);
	var totalPrize = toFloat($('eventResultTotalPrize').innerHTML);
	var totalRebuy = toFloat($('eventResultTotalRebuy').innerHTML);
	var totalAddon = toFloat($('eventResultTotalAddon').innerHTML);
	var totalBRA   = (totalBuyin+totalRebuy+totalAddon);
	
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

function checkBuyin(peopleId){
	
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
	
	var eventPosition = $('eventEventPosition'+peopleId).value;
	var eventBuyin    = $('eventBuyin').value;

	

	if( eventPosition && (eventPosition*1) > 0 ){

		$('eventBuyin'+peopleId).value = eventBuyin;
		
		if( !isRing(peopleId) )
			$('eventResultBuyin'+peopleId).innerHTML = toFloat(eventBuyin, true);
	}else
		$('eventBuyin'+peopleId).value = '0,00';
}

function openEventResult(){
	
	enableButton('eventResultSubmit');
	enableButton('calculatePrize');
	
	windowEventResultShow();
}

function toggleEventResultView(showResult){
	
	if( showResult ){
	
		hideDiv('eventResultPlayerListDiv');
		showDiv('eventResultTableDiv');
		showButton('toggleResultButtonPlayer');
		showButton('eventResultSubmit');
		showButton('calculatePrize');
		hideButton('toggleResultButtonResult');
	}else{

		showDiv('eventResultPlayerListDiv');
		hideDiv('eventResultTableDiv');
		hideButton('toggleResultButtonPlayer');
		hideButton('eventResultSubmit');
		hideButton('calculatePrize');
		showButton('toggleResultButtonResult');
	}
}