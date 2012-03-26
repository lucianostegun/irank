function doSubmitRanking(content){

	var isNew = ($('rankingId').value=='');
	
	if( !isNew ){
		
		if( $('rankingOldScoreSchema').value!=$('rankingScoreSchema').value ){
			$('rankingRecalculateScore').value = confirm(i18n_rankingScoreRecalculateConfirm)?'1':'0';
		}
	}
	
	showIndicator('ranking');
	disableButton('mainSubmit');
	$('rankingForm').onsubmit();
}

function handleSuccessRanking(rankingId){

	setRecordSaved(true);
	clearFormFieldErrors('rankingForm');
	
	showFormStatusSuccess();
	setButtonBarStatus('rankingMain', 'success');
	
	hideIndicator('ranking');
	enableButton('mainSubmit');
	
	var isNew            = ($('rankingId').value=='');
	var recalculateScore = ($('rankingRecalculateScore').value=='1');
	
	if( !$('rankingId').value )
		$('rankingId').value = rankingId;

	if( $('rankingRankingTag')!=null && $('rankingBuildEmailGroup')!=null && $('rankingBuildEmailGroup').checked ){
		
		$('rankingRankingTagText').innerHTML = $('rankingRankingTag').value+'@irank.com.br';
		hideDiv('rankingBuildEmailGroupRowDiv');
		hideDiv('rankingRankingTagField');
	}
	
	showDiv('mainMenuRanking');
	
	if( isNew || recalculateScore ){
		
		if( isNew ){
			
			reloadPlayerTab();
			tabBarMainObj.showTab('event');
			reloadOptionsTab();
		}
		
		reloadClassifyTab();
	}
	
	setLastBarPath($('rankingRankingName').value);
	
	$('rankingOldScoreSchema').value   = $('rankingScoreSchema').value;
	$('rankingRecalculateScore').value = '';
	
	onSelectTabRanking(tabBarMainObj.getActiveTab());
}

function handleFailureRanking(content){

	setButtonBarStatus('rankingMain', 'error');
	enableButton('mainSubmit');
	handleFormFieldError(content, 'rankingForm', 'ranking', false, 'ranking');
	
}

function doSubmitRankingPlayer(content){

	showIndicator('rankingPlayer');
	disableButton('rankingPlayerSubmit');
	$('rankingPlayerForm').onsubmit();
}

function addRankingPlayer(){

	$('rankingPlayerForm').reset();
	clearFormFieldErrors('rankingPlayerForm');
	hideFormStatusError('rankingPlayer');
	hideFormStatusSuccess('rankingPlayer');
	hideIndicator('rankingPlayer');
	enableButton('rankingPlayerSubmit');
	setButtonBarStatus('rankingPlayerAdd');
	windowRankingPlayerAddShow();
	
	if( isModuleName('event') ){
		
		$('rankingPlayerRankingId').value = $('eventRankingId').value;
		$('rankingPlayerEventId').value   = $('eventId').value;
	}else
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
	
	setButtonBarStatus('rankingPlayerAdd', 'success');
	
	hideIndicator('rankingPlayer');
	
	adjustContentTab();
	windowRankingPlayerAddHide();
}

function handleFailureRankingPlayer(content){
	
	enableButton('rankingPlayerSubmit');
	setButtonBarStatus('rankingPlayerAdd', 'error');
	handleFormFieldError(content, 'rankingPlayerForm', 'rankingPlayer', false, 'rankingPlayer');
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
	
	var rankingId = $('rankingId').value;
	
	var isLock = !(/unlock\.png/).test($('rankingShare'+peopleId).src);
	
	var lock = function(){
		
		$('rankingShare'+peopleId).src   = $('rankingShare'+peopleId).src.replace('lock', 'unlock');
		$('rankingShare'+peopleId).title = $('rankingShare'+peopleId).title.replace(i18n_enable, i18n_disable);
	}
	
	var unlock = function(){
		
		$('rankingShare'+peopleId).src   = $('rankingShare'+peopleId).src.replace('unlock', 'lock');
		$('rankingShare'+peopleId).title = $('rankingShare'+peopleId).title.replace(i18n_disable, i18n_enable);
	}
	
	if( isLock )
		lock();
	else
		unlock();
		
	var failureFunc = function(t){

		var content = t.responseText;

		
		if( isLock )
			unlock();
		else
			lock();

		alert(i18n_ranking_playersTab_shareError)
		
		if( isDebug() )
			debug(content);
	};
	
	var urlAjax = _webRoot+'/ranking/toggleShare/rankingId/'+rankingId+'/peopleId/'+peopleId;
	new Ajax.Request(urlAjax, {asynchronous:true, evalScripts:false, onFailure:failureFunc});
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

function toggleEmailAlias(checked){
	
	if( checked ){
		
		var rankingTagSuggest = $('rankingRankingName').value;
		rankingTagSuggest     = rankingTagSuggest.replace(/[^a-zA-z0-9_]/gi, '');
		rankingTagSuggest     = rankingTagSuggest.toLowerCase();
		
		$('rankingRankingTag').value = rankingTagSuggest;
		showDiv('rankingRankingTagRow');
	}else{
		
		$('rankingRankingTag').value = 'a_';
		hideDiv('rankingRankingTagRow');
	}
}

function showFreerollDetails(){
	
	showDiv('rankingFreerollDetailsTable', false, 'table');
}

function doUnsubscribeRanking(){
	
	// <!-- I18N -->
	if(!confirm('ATENÇÃO!\n\nAo sair do ranking você perderá todo o histórico e não receberá mais notificações dos eventos relacionados a ele.\n\nDeseja continuar?'))
		return false;
	// <!-- I18N -->	
	if(!confirm('Esta operação não poderá ser revertida.\n\nDeseja continuar?'))
		return false;

	var rankingId = $('rankingId').value;
	
	var successFunc = function(t){

		hideIndicator('ranking');
		
		var form = document.createElement('form');
		
		var rankingIdField   = document.createElement('input');
		rankingIdField.type  = 'hidden';
		rankingIdField.name  = 'rankingId';
		rankingIdField.value = rankingId;

		form.appendChild( rankingIdField );
		
		form.method = 'POST';
		form.action = _webRoot+'/ranking/unsubscribe';
		document.body.appendChild( form );
		
		form.submit();
	};
		
	var failureFunc = function(t){

		var content = t.responseText;
		
		var errorMessage = parseMessage(content);
		// <!-- I18N -->
		alert('Não foi possível sair deste ranking!'+content);
		
		hideIndicator('ranking');
		
		if( isDebug() )
			debug(content);
	};
	
	var urlAjax = _webRoot+'/ranking/validateUnsubscribe/rankingId/'+rankingId;
	new Ajax.Request(urlAjax, {asynchronous:true, evalScripts:false, onSuccess:successFunc, onFailure:failureFunc});
}

function handleRankingScoreSchema(scoreSchema){
	
	if( scoreSchema=='custom' ){
		
		showDiv('rankingScoreFormulaRowDiv');
		adjustContentTab();
	}else{
		
		hideDiv('rankingScoreFormulaRowDiv');
		$('rankingScoreFormula').value = '';
	}
}














function doSaveRankingScoreFormula(){
	
	if( doValidateRankingScoreFormula() ){
		
		$('rankingScoreFormula').value        = $('rankingScoreFormulaFormula').value;
		$('rankingScoreFormulaDiv').innerHTML = $('rankingScoreFormulaFormula').value;
		
		$('rankingOldScoreSchema').value = '';
		
		windowRankingScoreFormulaHide();
	}
}

function doValidateRankingScoreFormula(){
	
	if( checkRankingScoreFormula() ){
	
		$('rankingScoreFormulaFormula').className = '';
		$('rankingScoreFormulaFormula').title     = '';
		showDiv('rankingFormulaSuccessDiv');
		enableButton('rankingScoreFormulaSave');
		return true;
	}else{
		
		setInvalidFormula();
		return false;
	}
}

function checkRankingScoreFormula(){

	var formula = $('rankingScoreFormulaFormula').value;
	
	if( !formula )
		return false;
	
	formula = formula.toLowerCase();
	
	var position = 1;
	var events   = 1;
	var prize    = 1;
	var players  = 1;
	var buyins   = 1;
	var buyin    = 1;
	var itm      = 1;
	
	formula = formula.replace(/posi[cç][aã]o|position/gi, 'position');
	formula = formula.replace(/eventos|events/gi, 'events');
	formula = formula.replace(/pr[eê]mio|prize/gi, 'prize');
	formula = formula.replace(/jogadores|players/gi, 'players');
	formula = formula.replace(/buyins/gi, 'buyins');
	formula = formula.replace(/buyin/gi, 'buyin');
	formula = formula.replace(/itm/gi, 'itm');
	
	var formulaResult = null;
	
	try{
		
		eval('formulaResult = '+formula+';');
	}catch(error){
		
		return false;
	}
	
	if( formulaResult!=null )
		return true;
}

function setInvalidFormula(){
	
	$('rankingScoreFormulaFormula').className = 'formFieldError';
	$('rankingScoreFormulaFormula').title     = 'Invalid formula';
	disableButton('rankingScoreFormulaSave');
	hideDiv('rankingFormulaSuccessDiv')
}