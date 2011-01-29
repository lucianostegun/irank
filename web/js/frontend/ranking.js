function handleSuccessRanking(rankingId){

	setRecordSaved(true);
	clearFormFieldErrors('rankingForm');
	showFormStatusSuccess();
	hideIndicator('ranking');
	enableButton('mainSubmit');
	
	var isNew = ($('rankingId').value=='');
	$('rankingId').value = rankingId;
	
	if( isNew ){
		
		reloadPlayerTab();
		tabBarMainObj.showTab('event');
		reloadClassifyTab();
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

function handleSuccessRankingPlayer(content){
	
	$('rankingPlayerForm').reset();
	$('rankingPlayerDiv').innerHTML = content;
	
	reloadClassifyTab()
	
	enableButton('rankingPlayerSubmit');
	
	hideIndicator('rankingPlayer');
	
	adjustContentTab();
	windowRankingPlayerAddHide();
}

function deleteRankingPlayer(peopleId){
	
	showIndicator('rankingPlayerList');
	
	var rankingId = $('rankingId').value;
	
	var successFunc = function(t){

		var content = t.responseText;
		
		$('rankingPlayerDiv').innerHTML = content;
		
		hideIndicator('rankingPlayerList');
	};
		
	var failureFunc = function(t){

		var content = t.responseText;

		alert(i18n_ranking_playersTab_playerDeleteError)
		hideIndicator('rankingPlayerList');
	};
	
	var urlAjax = _webRoot+'/ranking/deletePlayer/rankingId/'+rankingId+'/peopleId/'+peopleId;
	new Ajax.Request(urlAjax, {asynchronous:true, evalScripts:false, onSuccess:successFunc, onFailure:failureFunc});
}

function onSelectTabRanking(tabId){

	hideDiv('rankingMainButtonBar');
	hideDiv('rankingPlayerButtonBar');
	
	switch( tabId ){
		case 'main':
			showDiv('rankingMainButtonBar');
			break;
		case 'player':
			if( isRecordSaved()!=false )
				showDiv('rankingPlayerButtonBar');
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