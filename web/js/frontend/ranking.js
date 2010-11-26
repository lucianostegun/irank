function handleSuccessRanking(content){

	setRecordSaved(true);
	clearFormFieldErrors('rankingForm');
	showFormStatusSuccess();
	hideIndicator('ranking');
	enableButton('mainSubmit');
	
	onSelectTabTask(tabBarMainObj.getActiveTab());
}

function doSubmitRanking(content){

	showIndicator('ranking');
	disableButton('mainSubmit');
	$('rankingForm').onsubmit();
}

function handleSuccessRankingPlayer(content){

	clearFormFieldErrors('rankingPlayerForm');
	showFormStatusSuccess('rankingPlayer');
	hideIndicator('rankingPlayer');
	enableButton('rankingPlayerSubmit');
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
	
	$('rankingPlayerFirstName').focus();
}

function handleSuccessRankingPlayer(content){
	
	$('rankingPlayerForm').reset();
	$('rankingPlayerDiv').innerHTML = content;
	
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

		alert('Não foi possível excluir o membro do grupo!\nTente novamente mais tarde.')
		hideIndicator('rankingPlayerList');
	};
	
	var urlAjax = _webRoot+'/ranking/deletePlayer/rankingId/'+rankingId+'/peopleId/'+peopleId;
	new Ajax.Request(urlAjax, {asynchronous:true, evalScripts:false, onSuccess:successFunc, onFailure:failureFunc});
}

function onSelectTabTask(tabId){

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

		alert('Não foi possível carregar o histórico de classificação!\nTente novamente mais tarde.')
	};
	
	putLoading('rankingClassifyDiv');
	
	var urlAjax = _webRoot+'/ranking/getRankingHistory/rankingId/'+rankingId+'?rankingDate='+rankingDate;
	new Ajax.Updater('rankingClassifyDiv', urlAjax, {asynchronous:true, evalScripts:false, onFailure:failureFunc});	
}