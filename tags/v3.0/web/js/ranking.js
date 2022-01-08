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

	if( typeof(window.opener)!='undefined' && typeof(window.opener.checkRankingTag)=='function' )
		window.opener.checkRankingTag();
		
	lockRankingTag();
	
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
		case 'notification':
			showDiv('rankingMainButtonBar');
			break;
	}
	
	return true;
}

function loadRankingHistory(rankingDate){
	
	var rankingId = $('rankingId').value;
	
	var successFunc = function(t){
		
		var content = t.responseText;
		
		$('rankingClassifyDiv').innerHTML = content;
		adjustContentTab();
	};
	
	var failureFunc = function(t){

		var content = t.responseText;

		alert(i18n_ranking_playersTab_logLoadError)
	};
	
	putLoading('rankingClassifyDiv');
	
	var urlAjax = _webRoot+'/ranking/getRankingHistory/rankingId/'+rankingId+'?rankingDate='+rankingDate;
	new Ajax.Request(urlAjax, {asynchronous:true, evalScripts:false, onFailure:failureFunc, onSuccess:successFunc});	
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
	
	showIndicator();
	disableButton('importRankingData');
	
	var rankingPlayers = $('rankingImportRankingPlayers').checked;
	
	var successFunc = function(t){

		hideIndicator();
		enableButton('importRankingData');
		
		if( rankingPlayers ){
			
			reloadPlayerTab();
			reloadClassifyTab();
		}
		
		alert(i18n_ranking_importSuccessMessage);
	};
		
	var failureFunc = function(t){

		var content = t.responseText;
		
		hideIndicator();
		
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
		alert('Não foi possível abandonar este ranking!'+errorMessage);
		
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
	
	formula = formula.replace(/raiz\(/gi, 'Math.sqrt(');
	
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
	$('rankingScoreFormulaFormula').title     = 'A fórmula digitada não é válida';
	disableButton('rankingScoreFormulaSave');
	hideDiv('rankingFormulaSuccessDiv')
}

function doRankingSearch(){
	
	showIndicator();
	
	var form = $('rankingSearchForm');
	
	if( isIE() ){
		
		$('isIE').value = true;
		form.submit()
		return false;
	}

	var successFunc = function(t){

		var content = t.responseText;
		$('rankingListContent').innerHTML = content;
		hideIndicator();
	};
		
	var failureFunc = function(t){

		var content = t.responseText;

		hideIndicator();
		
		var errorMessage = parseMessage(content);
		alert(i18n_ranking_searchError+(errorMessage?'\n'+errorMessage:''));
		
		if( !errorMessage && isDebug() )
			debug(content);
	};
	

	var urlAjax = _webRoot+'/ranking/search';
	new Ajax.Request(urlAjax, {asynchronous:true, evalScripts:false, onSuccess:successFunc, onFailure:failureFunc, parameters:Form.serialize(form)});
}

function sendSubscribeRequest(rankingId, cancel){
	
	if( cancel && !confirm('Deseja realmente cancelar o pedido de inscrição para este ranking?') )
		return false;
	
	showIndicator();
	
	disableButton('subscribeRequest');

	var successFunc = function(t){

		var content = t.responseText;
		
		if( content!='success' )
			return failureFunc(t);
		

		if( cancel )
			setButtonLabel('subscribeRequest', 'Enviar pedido', 'arrowRight.png');
		else
			setButtonLabel('subscribeRequest', 'Pedido já enviado', 'ok.png');
		
		$('subscribeRequestButton').onclick = function(){ sendSubscribeRequest(rankingId, !cancel) };
			
		enableButton('subscribeRequest');
		
		hideIndicator();
	};
		
	var failureFunc = function(t){

		var content = t.responseText;

		enableButton('subscribeRequest');
		hideIndicator();
		
		var errorMessage = parseMessage(content, 'Por favor, tente novamente.');
		alert('Não foi possível enviar sua requisição de inscrição ao ranking!'+errorMessage);
		
		console.log(content);
	};
	
	var urlAjax = _webRoot+'/ranking/requestSubscription/rankingId/'+rankingId+'/cancel/'+(cancel?'1':'0');
	new Ajax.Request(urlAjax, {asynchronous:true, evalScripts:false, onSuccess:successFunc, onFailure:failureFunc});
}

function toggleSubscriptionRequest(userSiteId, toggleAction){
	
	showIndicator();
	
	disableButton('subscriptionRequestAgree-'+userSiteId);
	disableButton('subscriptionRequestDecline-'+userSiteId);
	
	var rankingId = $('rankingId').value;
	
	var successFunc = function(t){
		
		var content = t.responseText;
		
		if( content!='success' )
			return failureFunc(t);
		
		if( toggleAction=='agree' )
			reloadPlayerTab();
		
		var tabLabel        = tabBarMainObj.getLabel('subscriptionRequest');
		var matches         = tabLabel.match(/^.* \(([0-9])\)$/);
		var pendingRequests = (matches[1]*1)-1;
		
		tabBarMainObj.setLabel('subscriptionRequest', 'Solicitações'+(pendingRequests > 0?' ('+pendingRequests+')':''));
		
		$('rankingSubscriptionRequestDecline-'+userSiteId).remove()
		$('rankingSubscriptionRequestAgree-'+userSiteId).innerHTML = 'Pedido '+(toggleAction=='agree'?'aceito':'recusado');
		$('rankingSubscriptionRequestAgree-'+userSiteId).addClassName(toggleAction+'d');
		$('rankingSubscriptionRequestAgree-'+userSiteId).colspan   = '2';
		
		hideIndicator();
	};
	
	var failureFunc = function(t){
		
		var content = t.responseText;
		
		enableButton('subscriptionRequestAgree-'+userSiteId);
		enableButton('subscriptionRequestDecline-'+userSiteId);
		
		hideIndicator();
		
		var errorMessage = parseMessage(content, 'Por favor, tente novamente.');
		alert('Não foi possível aceitar/recusar o pedido de inscrição ao ranking!'+errorMessage);
		
		console.log(content);
	};
	
	var urlAjax = _webRoot+'/ranking/toggleSubscriptionRequest/rankingId/'+rankingId+'/userSiteId/'+userSiteId+'/toggleAction/'+toggleAction;
	new Ajax.Request(urlAjax, {asynchronous:true, evalScripts:false, onSuccess:successFunc, onFailure:failureFunc});
}

function lockRankingTag(){
	
	if( $('rankingRankingTagField')==null )
		return;
	
	$('rankingRankingTagField').className = 'text flex';
	$('rankingRankingTagField').innerHTML = $('rankingRankingTag').value+'@irank.com.br';
	
	$('rankingBuildEmailGroupHelp').remove();
	$('rankingRankingTagError').remove();
}

function editRankingNotifications(){

	if( $('rankingUpdateNotifications')!=null )
		return tabBarMainObj.setTabActive('notification');
		
		
	showIndicator();
	
	var div = document.createElement('div');
	div.id = 'mainNotificationObjDiv';
	
	$('tabBarMainObjDiv').appendChild(div);
	
	var rankingId = $('rankingId').value;
	
	var completeFunc = function(t){
		
		tabBarMainObj.addTab('notification', 'Notificações', '100px');
		tabBarMainObj.setContent('notification','mainNotificationObjDiv');
		tabBarMainObj.setTabActive('notification');
		
		hideIndicator();
	};
	
	var failureFunc = function(t){
		
		var content = t.responseText;
		
		var errorMessage = parseMessage(content, 'Por favor, tente novamente.');
		alert('Não foi possível carregar as opções de notificação!'+errorMessage);
		
		if( isDebug() )
			console.log(content);
	};
	
	var urlAjax = _webRoot+'/ranking/getTabContent/tabId/notification/rankingId/'+rankingId;
	new Ajax.Updater('mainNotificationObjDiv', urlAjax, {asynchronous:true, evalScripts:false, onComplete:completeFunc, onFailure:failureFunc});
}