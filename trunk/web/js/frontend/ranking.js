function handleSuccessRanking(rankingId){

	setRecordSaved(true);
	clearFormFieldErrors('rankingForm');
	showFormStatusSuccess();
	hideIndicator('ranking');
	enableButton('mainSubmit');
	
	var isNew = ($('rankingId').value=='');
	
	if( !$('rankingId').value )
		$('rankingId').value = rankingId;
	
	showDiv('mainMenuRanking');
	
	if( isNew ){
		
		reloadPlayerTab();
		tabBarMainObj.showTab('event');
		reloadClassifyTab();
		reloadOptionsTab();
	}
	
	onSelectTabRanking(tabBarMainObj.getActiveTab());
}

function doSubmitRanking(content){

	showIndicator('ranking');
	disableButton('mainSubmit');
	$('rankingForm').onsubmit();
}

function doSubmitRankingPlayer(content){

	showIndicator('rankingPlayer');
	disableButton('rankingPlayerSubmit');
	$('rankingPlayerForm').onsubmit();
}

function addRankingPlayer(){
	
	clearFormFieldErrors('rankingPlayerForm');
	hideFormStatusError('rankingPlayer');
	hideFormStatusSuccess('rankingPlayer');
	hideIndicator('rankingPlayer');
	enableButton('rankingPlayerSubmit');
	windowRankingPlayerAddShow();
	
	if( isModuleName('event') )
		$('rankingPlayerRankingId').value = $('eventRankingId').value;
	else
		$('rankingPlayerRankingId').value = $('rankingId').value;
	
	$('rankingPlayerFirstName').focus();
}

function reloadPlayerTab(){

	var rankingId = $('rankingId').value;
	
	tabBarMainObj.showTab('player');
	
	var failureFunc = function(){
		
		$('rankingPlayerDiv').innerHTML = i18n_ranking_playerListLoadError;
	}
	
	var urlAjax = _webRoot+'/ranking/getPlayerList/rankingId/'+rankingId;
	new Ajax.Updater('rankingPlayerDiv', urlAjax, {asynchronous:true, evalScripts:false});
}

function reloadClassifyTab(){
	
	var rankingId = $('rankingId').value;
	
	tabBarMainObj.showTab('classify');
	
	var failureFunc = function(){
		
		$('rankingClassifyDiv').innerHTML = i18n_ranking_playerListLoadError;
	}
	
	var urlAjax = _webRoot+'/ranking/getClassifyList/rankingId/'+rankingId;
	new Ajax.Updater('rankingClassifyDiv', urlAjax, {asynchronous:true, evalScripts:false});
}

function reloadOptionsTab(){
	
	var rankingId = $('rankingId').value;
	
	tabBarMainObj.showTab('options');
	
	var failureFunc = function(){
		
		$('rankingOptionsDiv').innerHTML = i18n_ranking_optionsListLoadError;
	}
	
	var urlAjax = _webRoot+'/ranking/getOptionsList/rankingId/'+rankingId;
	new Ajax.Updater('mainOptionsObjDiv', urlAjax, {asynchronous:true, evalScripts:false});
}

function handleSuccessRankingPlayer(content){
	
	if( isModuleName('event') )
		return handleSuccessEventRankingPlayer(content);
		
	$('rankingPlayerForm').reset();
	$('rankingPlayerDiv').innerHTML = content;
	
	reloadClassifyTab()
	
	enableButton('rankingPlayerSubmit');
	
	hideIndicator('rankingPlayer');
	
	adjustContentTab();
	windowRankingPlayerAddHide();
}

function deleteRankingPlayer(peopleId){
	
	var rankingId = $('rankingId').value;
	
	hideDiv('rankingPlayer'+peopleId+'Tr');
	
	var successFunc = function(t){

	};
		
	var failureFunc = function(t){

		var content = t.responseText;

		alert(i18n_ranking_playersTab_playerDeleteError)
	};
	
	var urlAjax = _webRoot+'/ranking/deletePlayer/rankingId/'+rankingId+'/peopleId/'+peopleId;
	new Ajax.Request(urlAjax, {asynchronous:true, evalScripts:false, onSuccess:successFunc, onFailure:failureFunc});
}

function onSelectTabRanking(tabId){

	hideDiv('rankingMainButtonBar');
	hideDiv('rankingPlayerButtonBar');
	hideDiv('rankingImportButtonBar');
	
	switch( tabId ){
		case 'main':
			showDiv('rankingMainButtonBar');
			break;
		case 'player':
			if( isRecordSaved()!=false )
				showDiv('rankingPlayerButtonBar');
			break;
		case 'import':
			if( isRecordSaved()!=false )
				showDiv('rankingImportButtonBar');
			break;
		case 'options':
			showDiv('rankingMainButtonBar');
			break;
	}
	
	return true;
}

function loadRankingHistory(rankingDate){
	
	var rankingId = $('rankingId').value;
	
	var failureFunc = function(t){

		var content = t.responseText;

		alert(i18n_ranking_playersTab_logLoadError)
	};
	
	putLoading('rankingClassifyDiv');
	
	var urlAjax = _webRoot+'/ranking/getRankingHistory/rankingId/'+rankingId+'?rankingDate='+rankingDate;
	new Ajax.Updater('rankingClassifyDiv', urlAjax, {asynchronous:true, evalScripts:false, onFailure:failureFunc});	
}

function toggleRankingShare(peopleId){
	
	showIndicator('rankingPlayerList');
	
	var rankingId = $('rankingId').value;
	
	var successFunc = function(t){

		var content = t.responseText;
		
		if( content=='lock' ){
			
			$('rankingShare'+peopleId).src   = $('rankingShare'+peopleId).src.replace('lock', 'unlock');
			$('rankingShare'+peopleId).title = $('rankingShare'+peopleId).title.replace(i18n_enable, i18n_disable);
		}else{
			
			$('rankingShare'+peopleId).src   = $('rankingShare'+peopleId).src.replace('unlock', 'lock');
			$('rankingShare'+peopleId).title = $('rankingShare'+peopleId).title.replace(i18n_disable, i18n_enable);
		}
		
		hideIndicator('rankingPlayerList');
	};
		
	var failureFunc = function(t){

		var content = t.responseText;

		alert(i18n_ranking_playersTab_shareError)
		hideIndicator('rankingPlayerList');
		
		if( isDebug() )
			debug(content);
	};
	
	var urlAjax = _webRoot+'/ranking/toggleShare/rankingId/'+rankingId+'/peopleId/'+peopleId;
	new Ajax.Request(urlAjax, {asynchronous:true, evalScripts:false, onSuccess:successFunc, onFailure:failureFunc});
}

function doDeleteRanking(){
	
	if( !confirm(i18n_ranking_deleteConfirm) )
		return false;
	
	showIndicator('ranking');
	
	disableButton('mainSubmit');
	disableButton('deleteRanking');
	
	var rankingId = $('rankingId').value;
	
	var successFunc = function(t){

		goModule('ranking', 'index')
		hideIndicator('ranking');
	};
		
	var failureFunc = function(t){

		var content = t.responseText;

		hideIndicator('ranking');
		
		enableButton('mainSubmit');
		enableButton('deleteRanking');
		
		var errorMessage = parseMessage(content);
		alert(i18n_ranking_deleteError+'\n'+(errorMessage?errorMessage:i18n_tryAgain));
		
		if( !errorMessage && isDebug() )
			debug(content);
	};
	
	var urlAjax = _webRoot+'/ranking/delete/rankingId/'+rankingId;
	new Ajax.Request(urlAjax, {asynchronous:true, evalScripts:false, onSuccess:successFunc, onFailure:failureFunc});
}

function importRankingData(){
	
	tabBarMainObj.showTab('import');
	tabBarMainObj.setTabActive('import');
}

function doImportRankingData(){
	
	showIndicator('ranking');
	disableButton('importRankingData');
	
	var rankingPlayers = $('rankingImportRankingPlayers').checked;
	
	var successFunc = function(t){

		hideIndicator('ranking');
		enableButton('importRankingData');
		
		if( rankingPlayers ){
			
			reloadPlayerTab();
			reloadClassifyTab();
		}
		
		alert(i18n_ranking_importSuccessMessage);
	};
		
	var failureFunc = function(t){

		var content = t.responseText;
		
		hideIndicator('ranking');
		
		enableButton('importRankingData');

		handleFormFieldError( content, 'rankingForm', 'ranking', false, 'ranking' );
		
		if( isDebug() )
			debug(content);
	};
	
	var urlAjax = _webRoot+'/ranking/import';
	new Ajax.Request(urlAjax, {asynchronous:true, evalScripts:false, onSuccess:successFunc, onFailure:failureFunc, parameters:Form.serialize($('rankingForm'))});
}

function calculateTotalSplitPrize(paidPlace){
	
	var percentList = $('rankingSplitPrizePercentList'+paidPlace).value.replace(/ ?% ?/gi, '');
	percentList     = percentList.split(/ ?[,;] ?/);

	var totalPercent = 0;
	for(var i=0; i < percentList.length; i++)
		totalPercent += (percentList[i]*1);
	
	$('percent'+paidPlace+'PlacesTotal').innerHTML = toFloat(totalPercent, true, 0)+'%';
}