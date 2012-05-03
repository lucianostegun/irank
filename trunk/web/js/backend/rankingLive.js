$(function() {
	
	createEventListTable();
	
	$('.tags').tagsInput({
		width: '100%', 
		delimiter: '|',
		defaultText: 'Fórmula'});
});

function createEventListTable(){
	
	eventListTable = $('#eventLiveTable').dataTable({
		"bJQueryUI": true,
		"sPaginationType": "full_numbers",
		"sDom": '<""l>t<"F"fp>',
		"aoColumns": [null,
		              null,
		              {"sType": "date-euro"},
		              null,
		              null,
		              null],
  		"aaSorting": [[2, "desc"]],
	});
	
	$('#eventLiveTable').css('width', '100%')
}

function handleSuccessRankingLive(content){

	var rankingLiveObj = parseInfo(content);
	
	clearFormFieldErrors();
	showFormStatusSuccess();
	
	mainRecordName = $('#rankingLiveRankingName').val();
	updateMainRecordName(mainRecordName, true);
	
	if( rankingLiveObj.reloadEvents ){
		
		updateEventTable();
		clearQuickEventLiveForm();
	}
}

function handleFailureRankingLive(content){
	
	handleFormFieldError(content, 'rankingLive');
}

function updateFileUploadStatus(status, fileName){
	
	switch(status){
		case 'success':
			var rankingLiveId = $('#rankingLiveId').val();
			
			fileName = fileName.replace(/(\.[a-zA-Z]*)$/, '-'+rankingLiveId+'$1');
			
			var link = '<a href="javascript:void(0)" onclick="goToPage(\'rankingLive\', \'downloadLogo\', \'rankingLiveId\', '+rankingLiveId+')"><img src="'+_imageRoot+'/ranking/'+fileName+'?time='+time()+'" /></a>'
			$('#rankingLiveFileNameLogoDiv').html(link);
			break;
		case 'loading':
			$('#rankingLiveFileNameLogoDiv').html('Carregando arquivo...');
			break;
		case 'error':
			$('#rankingLiveFileNameLogoDiv').html('Não informado');
			alert('Erro ao carregar o arquivo!\nVerifique se o arquivo é uma imagem JPG ou PNG de 90x90 pixels');
			break;
	}
}

function handleIsFreeroll(checked){
	
	$('#rankingLiveBuyin').attr('disabled', checked);
}

function handleIsIlimitedRebuys(checked){
	
	$('#rankingLiveAllowedRebuys').attr('disabled', checked);
}

function updatePrizeSplitLabel(){
	
	var splitValue = $('#rankingLivePrizeSplit').val();
	if( !splitValue )
		return $('#prizeSplitTotalLabel').html('0%');
	
	splitValue = splitValue.split(/[(; ?)(, +)]/);
	var totalPercent = 0;
	
	for(var i=0; i < splitValue.length; i++)
		totalPercent += toFloat(splitValue[i]);

	totalPercent = toCurrency(totalPercent, 1)+'%';
	totalPercent = totalPercent.replace(',0%', '%');
	$('#prizeSplitTotalLabel').html(totalPercent);
}

function showAddEventForm( showForm ){
	
	if( showForm ){
		
		hideDiv('eventListDiv');
		showDiv('quickAddEventFormDiv');

		hideDiv('showAddEventLink');
		showDiv('hideAddEventLink');
	} else{
		
		showDiv('eventListDiv');
		hideDiv('quickAddEventFormDiv');

		showDiv('showAddEventLink');
		hideDiv('hideAddEventLink');
	}
}

_addQuickEventCount = 10;
function validateQuickAddEvent( rowId ){
	
	var eventName  = $('#rankingLiveQuickEventLiveEventName'+rowId).val();
	var clubId     = $('#rankingLiveQuickEventLiveClubId'+rowId).val();
	var eventDate  = $('#rankingLiveQuickEventLiveEventDate'+rowId).val();
	var startTime  = $('#rankingLiveQuickEventLiveStartTime'+rowId).val();
	var buyinValue = $('#rankingLiveBuyin').val();
	var freeroll   = $('#rankingLiveIsFreeroll').val();
	var blindTime  = $('#rankingLiveBlindTime').val();
	var stackChips = $('#rankingLiveStackChips').val();
	stackChips     = stackChips.replace(/[Kk]/gi, '000');
	stackChips     = stackChips*1;
	
	var getIcon = function(color, title){
		
		return '<img src="'+_imageRoot+'/backend/icons/icon'+ucfirst(color)+'.png" title="'+title+'" />';
	}
	
	if(!eventName || !clubId || !eventDate || !startTime)
		$('#quickAddEventLiveInfo'+rowId).html(getIcon('red', 'Favor preencher todos os campos'));
	else if (!/^([0-2][0-9]|3[01])[/](0[0-9]|1[0-2])[/][0-9]{4}$/.test(eventDate))
		$('#quickAddEventLiveInfo'+rowId).html(getIcon('yellow', 'A data informada não é válida'));
	else if (!/^([0-1][0-9]|2[0-3]):[0-5][0-9]$/.test(startTime))
		$('#quickAddEventLiveInfo'+rowId).html(getIcon('yellow', 'A hora informada não é válida'));
	else if (!/^[0-9][0-9]:[0-5][0-9]$/.test(blindTime))
		$('#quickAddEventLiveInfo'+rowId).html(getIcon('yellow', 'Favor verificar a duração dos blinds na aba valores padrão'));
	else if ( !freeroll && !/^[0-9]+([,.][0-9]{1,2})?$/.test(buyinValue))
		$('#quickAddEventLiveInfo'+rowId).html(getIcon('yellow', 'Favor verificar o buy-in na aba valores padrão'));
	else if ( isNaN(stackChips) || stackChips<1 )
		$('#quickAddEventLiveInfo'+rowId).html(getIcon('yellow', 'Favor verificar o Stack inicial na aba valores padrão'));
	else{
		
		$('#quickAddEventLiveInfo'+rowId).html(getIcon('green', 'Campos validados. Evento pronto para ser salvo'));
		//TODO: fazer requisição ajax para salvar
	}
}

function validateAllQuickAddEvent(){
	
	for(var rowId=1; rowId<=_addQuickEventCount; rowId++)
		validateQuickAddEvent( rowId )
}

function updateEventTable(){
	
	var rankingLiveId = $('#rankingLiveId').val();
	
	var successFunc = function(content){

		$('#rankingLiveEventLiveList').html(content);
		eventListTable.fnDestroy();
		createEventListTable();
	};
		
	var failureFunc = function(t){

		var content = t.responseText;

		if( isDebug() )
			debug(content);
	};
	
	var urlAjax = _webRoot+'/rankingLive/getEventLiveList?rankingLiveId='+rankingLiveId;
	AjaxRequest(urlAjax, {asynchronous:true, evalScripts:false, onSuccess:successFunc, onFailure:failureFunc});	
}

function clearQuickEventLiveForm(){
	
	showAddEventForm();
	
	for(var i=1; i <= 12; i++){
		
		$('#rankingLiveQuickEventLiveEventName'+i).val('');
		$('#rankingLiveQuickEventLiveEventDate'+i).val('');
		$('#rankingLiveQuickEventLiveStartTime'+i).val($('#rankingLiveStartTime').val());
		
		if( $('#rankingLiveQuickEventLiveClubId1').prop('type')!='hidden' )
			$('#rankingLiveQuickEventLiveClubId'+i).val('');
	}
	
	validateAllQuickAddEvent();
	$.uniform.update();
}

function handleScoreFormulaOption(scoreFormulaOption){
	
	if( scoreFormulaOption=='simple' ){
		
		if( $('#rankingLiveScoreFormula').val()=='0' )
			$('#rankingLiveScoreFormula').val('');
		
		$('#rankingLiveScoreFormulaMultipleDiv').hide();
		$('#rankingLiveScoreFormulaSimpleDiv').show();
	}else{
		
		$('#rankingLiveScoreFormula').val('0');
		$('#rankingLiveScoreFormulaSimpleDiv').hide();
		$('#rankingLiveScoreFormulaMultipleDiv').show();
	}
}

function replicateStartTime(startTime){
	
	$('.rankingLiveQuickEventStartTime').val(startTime);
}