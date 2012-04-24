function handleSuccessRankingLiveIndex(content){
	
	if( content ){
		
		var rankingLiveIdList = content.split(',');
		
		removeTableRows('rankingLive', rankingLiveIdList);
	}
	
	hideIndicator();
}

function handleFailureRankingLiveIndex(content){
	
	hideIndicator();
	var errorMessage = parseMessage(content);
	
	alert('Não foi possível excluir um ou mais registros selecionados!'+errorMessage);
}

function handleSuccessRankingLive(content){

	clearFormFieldErrors();
	showFormStatusSuccess();
	
	mainRecordName = $('#rankingLiveRankingName').val();
	updateMainRecordName(mainRecordName, true);
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
	
	var eventName     = $('#eventName'+rowId).val();
	var clubId        = $('#clubId'+rowId).val();
	var eventDate     = $('#eventDate'+rowId).val();
	var startTime     = $('#startTime'+rowId).val();
	var buyinValue    = $('#rankingLiveBuyin').val();
	var freeroll      = $('#rankingLiveIsFreeroll').val();
	var blindTime     = $('#rankingLiveBlindTime').val();
	var stackChips    = $('#rankingLiveStackChips').val();
	stackChips        = stackChips.replace(/[Kk]/gi, '000');
	stackChips        = stackChips*1;
	
	if(!eventName || !clubId || !eventDate || !startTime)
		$('#quickAddEventLiveInfo'+rowId).html('<img src="/images/backend/icons/iconRed.png" title="Favor preencher todos os campos" />');
	else if (!/^([0-2][0-9]|3[01])[/](0[0-9]|1[0-2])[/][0-9]{4}$/.test(eventDate))
		$('#quickAddEventLiveInfo'+rowId).html('<img src="/images/backend/icons/iconYellow.png" title="A data informada é inválida" />');
	else if (!/^([0-1][0-9]|2[0-3]):[0-5][0-9]$/.test(startTime))
		$('#quickAddEventLiveInfo'+rowId).html('<img src="/images/backend/icons/iconYellow.png" title="A hora informada é inválida" />');
	else if (!/^[0-9][0-9]:[0-5][0-9]$/.test(blindTime))
		$('#quickAddEventLiveInfo'+rowId).html('<img src="/images/backend/icons/iconYellow.png" title="Favor verificar a duração dos blinds na aba valores padrão" />');
	else if ( !freeroll && !/^[0-9]+([,.][0-9]{1,2})?$/.test(buyinValue))
		$('#quickAddEventLiveInfo'+rowId).html('<img src="/images/backend/icons/iconYellow.png" title="Favor verificar o buy-in na aba valores padrão" />');
	else if ( isNaN(stackChips) || stackChips<1 )
		$('#quickAddEventLiveInfo'+rowId).html('<img src="/images/backend/icons/iconYellow.png" title="Favor verificar o Stack inicial na aba valores padrão" />');
	else{
		
		$('#quickAddEventLiveInfo'+rowId).html('<img src="/images/backend/icons/iconGreen.png" title="Campos validados" />');
		//fazer requisição ajax para salvar
	}
}

function validateAllQuickAddEvent(){
	
	for(var rowId=1; rowId<=_addQuickEventCount; rowId++)
		validateQuickAddEvent( rowId )
}
