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
		
		$('rankingPlayerDiv').innerHTML = 'Não foi possível carregar a lista de jogadores!';
	}
	
	var urlAjax = _webRoot+'/ranking/getPlayerList/rankingId/'+rankingId;
	new Ajax.Updater('rankingPlayerDiv', urlAjax, {asynchronous:true, evalScripts:false});
}

function reloadClassifyTab(){
	
	var rankingId = $('rankingId').value;
	
	tabBarMainObj.showTab('classify');
	
	var failureFunc = function(){
		
		$('rankingClassifyDiv').innerHTML = 'Não foi possível carregar a lista de jogadores!';
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

		alert('Não foi possível excluir o membro do grupo!\nTente novamente mais tarde.')
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

		alert('Não foi possível carregar o histórico de classificação!\nTente novamente mais tarde.')
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
			$('rankingShare'+peopleId).title = $('rankingShare'+peopleId).title.replace('Habilitar', 'Desabilitar');
		}else{
			
			$('rankingShare'+peopleId).src   = $('rankingShare'+peopleId).src.replace('unlock', 'lock');
			$('rankingShare'+peopleId).title = $('rankingShare'+peopleId).title.replace('Desabilitar', 'Habilitar');
		}
		
		hideIndicator('rankingPlayerList');
	};
		
	var failureFunc = function(t){

		var content = t.responseText;

		alert('Não foi possível habilitar o membro do grupo para edição do ranking!\nTente novamente mais tarde.')
		hideIndicator('rankingPlayerList');
		
		if( isDebug() )
			debug(content);
	};
	
	var urlAjax = _webRoot+'/ranking/toggleShare/rankingId/'+rankingId+'/peopleId/'+peopleId;
	new Ajax.Request(urlAjax, {asynchronous:true, evalScripts:false, onSuccess:successFunc, onFailure:failureFunc});
}

function doDeleteRanking(){
	
	if( !confirm('ATENÇÃO!\n\nAo excluir o ranking todas as informações de eventos e resultados serão perdidas.\nOs participantes do ranking serão notificados da exclusão.\n\n Deseja realmente excluir este ranking?') )
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
		alert('Não foi possível excluir o ranking!\n'+(errorMessage?errorMessage:'Tente novamente mais tarde.'));
		
		if( !errorMessage && isDebug() )
			debug(content);
	};
	
	var urlAjax = _webRoot+'/ranking/delete/rankingId/'+rankingId;
	alert(urlAjax);
	new Ajax.Request(urlAjax, {asynchronous:true, evalScripts:false, onSuccess:successFunc, onFailure:failureFunc});
}