var _eventLiveConfirmSaveResult = true;
var _eventLivePeopleId          = null;

$(function() {
	
	var eventLiveId = $('#eventLiveId').val();
	var urlAjax     = _webRoot+'/eventLive/uploadPhotos?eventLiveId='+eventLiveId;
	
	$('#eventLivePhotosUploader').pluploadQueue({
		runtimes : 'html5,html4',
		url : urlAjax,
		max_file_size : '4mb',
		unique_names : true,
		filters : [
			{title : 'Arquivos de imagem', extensions : 'jpg,png'}
			// {title : 'Zip files', extensions : 'zip'}
		],
		init : {
			Refresh: function(up) {
				// Called when upload shim is moved
			},
			
			StateChanged: function(up) {
				// Called when the state of the queue is changed
				if(up.state == plupload.STOPPED)
					updateEventLivePhotoList();
			},
		},
	});
	
	if( getActionName()!='index' ){
	
		buildEventLiveLightbox();
		clearFormFieldErrors('eventLiveResult');
		
		if( !$('#eventLiveEventDate').attr('disabled') ){
			
			$('#eventLiveEventDate').datepicker({ 
				defaultDate: +0,
				autoSize: false,
				dateFormat: 'dd/mm/yy',
				onSelect: function(dateText){
					loadEventStats();
				}
			});
		}
	}
	
	updateEventLiveStepDatePicker = function(){
		
		$('.stepEventDate').datepicker({ 
			defaultDate: +0,
			autoSize: false,
			dateFormat: 'dd/mm/yy',
			onSelect: function(dateText){
				
			}
		});

		updateFieldMasks();
	}
	
	updateEventLiveStepDatePicker();
});

function doDeleteEventLive(){
	
	var rankingLiveId = $('#eventLiveRankingLiveId').val();
	
	if( rankingLiveId && !confirm('ATENÇÃO!\n\nAo excluir este evento, o resultado de todos os eventos posteriores serão afetados!\nTem certeza que deseja excluir o evento?') )
		return false;
	
	doDeleteMain();
}

function handleSuccessEventLive(content){

	clearFormFieldErrors();
	clearFormFieldErrors('eventLiveResult');
	showFormStatusSuccess();
	
	$('#mainResultTab').show();
	$('#mainDisclosureTab').show();
	
	mainRecordName = ($('#eventLiveEventShortName').val()?$('#eventLiveEventShortName').val():$('#eventLiveEventName').val());
	updateMainRecordName(mainRecordName, true);
	
	$('#eventLiveResultForm').submit();
}

function handleFailureEventLive(content){
	
	handleFormFieldError(content, 'eventLive');
	handleFormFieldError(content, 'eventLiveResult');
}

function handleSuccessEventLiveResult(content){
	
	var eventLiveObj = parseInfo(content);

	// Se o resultado já foi salvo
	if( eventLiveObj.savedResult ){
		
		// Se pediu para publicar o resultado
		if( $('#eventLiveResultPublish').val()=='1' )
			showFormStatusSuccess();
		
		if( $('#pendingResultWarning').is('visible') )
			$('#pendingResultWarning').click();
		
		if( !$('#eventLiveEventDate').attr('readOnly') ){
			
			$('#eventLiveEventDate').attr('disabled', 'disabled');
			$('#eventLiveEventDate').attr('name', 'eventDateOld');
			$('#eventLiveEventDateTmp').attr('name', 'eventDate');
		}
		
		$('#playerIncluderRow').hide();
		$('.playerRemoveColumn').hide();
	}
	
	removeTabError('mainResultTab');
	removeTabError('resultTab');
}

function handleFailureEventLiveResult(content){
	
	setTabError('mainResultTab');
	setTabError('resultTab');
	
	if( $('#eventLiveResultPublish').val()=='1' ){
		
		hideIndicator();
		alert('Não foi possível salvar o resultado deste evento!\nPor favor, tente novamente.');
		
		if( isDebug() )
			debug(content);
	}else{

		handleFormFieldError(content, 'eventLiveResult');
	}
}

function replicateEventName(eventName){
	
	if( $('#eventLiveEventShortName').val()!='' )
		return;
	
	var matches = eventName.match(/([0-9]*)[ºªa] *etapa/i);
	if( matches && matches.length > 0 )
		$('#eventLiveEventStepNumber').val( matches[1] );

	matches = eventName.match(/Dia *([0-9]*-?[a-zA-z]*) ?/i);
//	if( matches && matches.length > 0 )
//		$('#eventLiveEventStepDay').val( matches[1] );
		
	
	eventName = eventName.replace(/ ?-.*Garantidos?/i, '');
	eventName = eventName.replace(/ ?Garantidos?/i, '');
	eventName = eventName.replace(/ ?-.*/, '');
	$('#eventLiveEventShortName').val( eventName.substring(0, 35) );
}

function updateEventNamePreview(){
	
	var stepNumber      = $('#eventLiveEventStepNumber').val();
	var eventName       = $('#eventLiveEventName').val();
	var guaranteedPrize = toFloat($('#eventLiveGuaranteedPrize').val());
	
	if( stepNumber )
		stepNumber = stepNumber+'ª Etapa ';
	
	if( guaranteedPrize && guaranteedPrize > 0 ){
		
		if( guaranteedPrize >= 1000 )
			guaranteedPrize = (guaranteedPrize/1000)+'K';
		
		guaranteedPrize = ' - '+guaranteedPrize+' GTD';
	}else
		guaranteedPrize = '';
	
	var eventNamePreview = stepNumber+eventName+guaranteedPrize;
	
	$('#eventLiveEventNamePreview').html(eventNamePreview);
}

function handleIsIlimitedRebuys(checked){
	
	$('#eventLiveAllowedRebuys').attr('disabled', checked);
}

function handleIsFreeroll(checked){
	
	$('#eventLiveBuyin').attr('disabled', checked);
}

function handleIsMultiday(checked){
	
	if( checked ){
		
		$('#eventLiveStepDayRowDiv').show();
		$('#eventLiveEventDateRowDiv').hide();
		
		if( $('#eventLiveStepDayCurrentIndex').val()*1 < 0 )
			addStepDay()
		
	}else{
		
		$('#eventLiveEventDateRowDiv').show();
		$('#eventLiveStepDayRowDiv').hide();
	}
}

function handleSelectEventLivePlayer(peopleId, peopleName){

	if( peopleId=='quickNew' )
		addQuickNewPlayer(peopleName, addPlayer)
	else
		addPlayer(peopleId);
}

function addPlayer(peopleId){
	
	var enrollmentMode = $('#eventLiveEnrollmentMode').val();
	if( enrollmentMode=='elimination' ){
		
		_eventLivePeopleId = peopleId;
		$('#eventLiveEventPosition').focus();
		return;
	}
	
	showIndicator();
	
	var eventLiveId = $('#eventLiveId').val();
	peopleId        = peopleId.replace(/[^0-9]/gi, '');
	
	var successFunc = function(content){
		
		if( content=='noChange' ){
			
			hideIndicator();
			$('#eventLivePeopleName').val('Jogador já confirmado no evento');
			$('#eventLivePeopleName').select();
			window.setTimeout('clearEventLivePeopleName()', 3000);
			return;
		}

		$('#eventLivePlayerIdTbody').html(content);
		$('#eventLivePeopleName').val('');
		$('#eventLivePeopleName').focus();
		
		// Aqui não oculta o indicator porque ainda vai executar o método
		// updateEventPlayerResultTable()
		updateEventPlayerResultTable();
		updateEventLiveStats();
	}

	var failureFunc = function(t){
		
		hideIndicator();
		
		var errorMessage = parseMessage(t.responseText);
		errorMessage = (errorMessage?errorMessage:'\nPor favor, tente novamente.');
		
		alert('FALHA NA CONFIRMAÇÃO!\n'+errorMessage);
		
		$('#eventLivePeopleName').focus();
		
		if( isDebug() )
			debug(t.responseText);
	}
	
	var urlAjax = _webRoot+'/eventLive/addPlayer/eventLiveId/'+eventLiveId+'/peopleId/'+peopleId;
	AjaxRequest(urlAjax, {asynchronous:true, evalScripts:false, onFailure:failureFunc, onSuccess:successFunc});	
}

function eliminatePlayer(){
	
	var enrollmentMode = $('#eventLiveEnrollmentMode').val();
	if( enrollmentMode!='elimination' || !_eventLivePeopleId )
		return;
	
	var eventLiveId   = $('#eventLiveId').val();
	var eventPosition = $('#eventLiveEventPosition').val()*1;
	peopleId          = _eventLivePeopleId;
	
	if( !eventPosition || !isNumeric(eventPosition) )
		return alert('Informe a posição em que o jogador foi eliminado!');
	else if ( eventPosition > getEventLivePlayers() )
		return alert('A posição informada é maior que o número atual de jogadores!');
	
	var peopleName = $('#eventLivePlayer-peopleName-'+peopleId).html();
	if( !confirm('ATENÇÃO!\n\nConfirma a eliminação do jogador "'+peopleName+'" na '+eventPosition+'ª posição?') )
		return;
	
	showIndicator();
	
	var successFunc = function(content){
		
		$('#eventLivePlayerIdTbody').html(content);
		$('#eventLivePeopleName').val('');
		$('#eventLiveEventPosition').val('');
		$('#eventLivePeopleName').focus();
		
		updateEventPlayerResultTable();
	}
	
	var failureFunc = function(t){
		
		hideIndicator();
		
		var errorMessage = parseMessage(t.responseText);
		errorMessage = (errorMessage?errorMessage:'\nPor favor, tente novamente.');
		
		alert('FALHA NA ELIMINAÇÃO!\n'+errorMessage);
		
		$('#eventLivePeopleName').focus();
		
		if( isDebug() )
			debug(t.responseText);
	}
	
	var urlAjax = _webRoot+'/eventLive/eliminatePlayer/eventLiveId/'+eventLiveId+'/peopleId/'+peopleId+'/eventPosition/'+eventPosition;
	AjaxRequest(urlAjax, {asynchronous:true, evalScripts:false, onFailure:failureFunc, onSuccess:successFunc});	
}

function removePlayer(peopleId){
	
	showIndicator();
	
	var eventLiveId = $('#eventLiveId').val();
	
	var successFunc = function(t){
		
		var content = t.responseText;
		
		hideDiv('eventLivePeopleIdRow-'+peopleId);
		
		var players = getEventLivePlayers();
		players     = (players-1)+' Jogador'+(players==0?'':'es')+' confirmado'+(players==0?'':'s')

		// Aqui não oculta o indicator porque ainda vai executar o método
		// updateEventPlayerResultTable()
		updateEventPlayerResultTable();
		updateEventLiveStats();
	}
	
	var failureFunc = function(t){
		
		hideIndicator();
		
		var errorMessage = parseMessage(t.responseText);
		errorMessage = (errorMessage?errorMessage:'\nPor favor, tente novamente.');
		
		alert('Não foi possível remover o jogador do evento!\n'+errorMessage);
		
		if( isDebug() )
			debug(t.responseText);
	}
	
	var urlAjax = _webRoot+'/eventLive/removePlayer/eventLiveId/'+eventLiveId+'/peopleId/'+peopleId;
	AjaxRequest(urlAjax, {asynchronous:true, evalScripts:false, onFailure:failureFunc, onSuccess:successFunc});	
}

function cutUnconfirmedPlayers(){
	
	if( !confirm('ATENÇÃO!\n\nConfirma a remoção de todos os jogadores não confirmados?') )
		return false;
	
	showIndicator();
	
	var eventLiveId = $('#eventLiveId').val();
	
	var successFunc = function(content){
		
		updateEventPlayerTable();
		updateEventPlayerResultTable();
		updateEventLiveStats();
	}
	
	var failureFunc = function(t){
		
		hideIndicator();
		
		var errorMessage = parseMessage(t.responseText);
		errorMessage = (errorMessage?errorMessage:'\nPor favor, tente novamente.');
		
		alert('Não foi possível remover os jogadores do evento!\n'+errorMessage);
		
		if( isDebug() )
			debug(t.responseText);
	}
	
	var urlAjax = _webRoot+'/eventLive/cutUnconfirmedPlayers/eventLiveId/'+eventLiveId;
	AjaxRequest(urlAjax, {asynchronous:true, evalScripts:false, onFailure:failureFunc, onSuccess:successFunc});	
}

function clearEventLivePeopleName(){
	
	if( $('#eventLivePeopleName').val()!='Jogador já confirmado no evento' )
		return;
		
	$('#eventLivePeopleName').val('');
	$('#eventLivePeopleName').focus();
}

function handleSelectEventLivePlayerResult(peopleId, peopleName, eventPosition){

	peopleId = peopleId.replace(/[^0-9]/gi, '');
	
	setPlayerResult(peopleId, peopleName, eventPosition);
}

function setPlayerResult(peopleId, peopleName, eventPosition){
	
	showIndicator();
	
	var eventLiveId = $('#eventLiveId').val();
	
	var successFunc = function(content){
		
		var infoObj = parseInfo(content);
		
		$('#eventLivePeopleNameResult-'+eventPosition).val( infoObj.peopleName );
		$('#peopleIdPosition-'+eventPosition).val( peopleId );
		$('#eventLiveResultEmailAddressTd-'+eventPosition).html( infoObj.emailAddress );

		if( $('#eventLivePeopleNameResult-'+(eventPosition+1)).length > 0 )
			$('#eventLivePeopleNameResult-'+(eventPosition+1)).focus();
		
		if( infoObj.eventPositionOld && infoObj.eventPositionOld!=eventPosition ){
			
			var eventPositionOld = infoObj.eventPositionOld

			$('#eventLivePeopleNameResult-'+eventPositionOld).val('');
			$('#peopleIdPosition-'+eventPositionOld).val('');
			$('#prize-'+eventPosition).val( $('#prize-'+eventPositionOld).val() );
			$('#prize-'+eventPositionOld).val('0,00');
			$('#score-'+eventPosition).val( $('#score-'+eventPositionOld).val());
			$('#score-'+eventPositionOld).val('0,00');
			$('#eventLiveResultEmailAddressTd-'+eventPositionOld).html( '' );
		}
		
		hideIndicator();
	}
	
	var failureFunc = function(t){
		
		hideIndicator();
		
		var errorMessage = parseMessage(t.responseText);
		errorMessage = (errorMessage?errorMessage:'\nPor favor, tente novamente.');
		
		alert('Não foi possível definir a posição do jogador no evento!\n'+errorMessage);
		
		if( isDebug() )
			debug(t.responseText);
	}
	
	var urlAjax = _webRoot+'/eventLive/savePlayerPosition/eventLiveId/'+eventLiveId+'/peopleId/'+peopleId+'/eventPosition/'+eventPosition;
	AjaxRequest(urlAjax, {asynchronous:true, evalScripts:false, onFailure:failureFunc, onSuccess:successFunc});
}

function checkEventPositionField(eventPosition){
	
	var peopleName = $('#eventLivePeopleNameResult-'+eventPosition).val();
	
	if( !peopleName )
		resetEventPosition(eventPosition);
}

function resetEventPosition(eventPosition){
	
	var eventLiveId = $('#eventLiveId').val();
	
	var successFunc = function(t){
		
		var content = t.responseText;
		
		$('#eventLivePeopleNameResult-'+eventPosition).val('');
		$('#peopleIdPosition-'+eventPosition).val('');
		$('#prize-'+eventPosition).val('0,00');
		$('#score-'+eventPosition).val('0');
		$('#eventLiveResultEmailAddressTd-'+eventPosition).html( '' );
	}
	
	var failureFunc = function(t){
		
		alert('Não foi possível limpar a posição '+eventPosition+' no evento!');
		
		if( isDebug() )
			debug(t.responseText);
	}
	
	var urlAjax = _webRoot+'/eventLive/resetEventPosition/eventLiveId/'+eventLiveId+'/eventPosition/'+eventPosition;
	AjaxRequest(urlAjax, {asynchronous:true, evalScripts:false, onFailure:failureFunc, onSuccess:successFunc});
}

function publishEventLiveResult(){
	
	var players = getEventLivePlayers();
	
	var missingPlayerAlert = false;
	var missingScoreAlert  = false;
	
	for(var eventPosition=1; eventPosition <= players; eventPosition++){
		
		if( $('#peopleIdPosition-'+eventPosition)==null || !$('#peopleIdPosition-'+eventPosition).val() )
			missingPlayerAlert = true;
		if( $('#score-'+eventPosition)==null || toFloat($('#score-'+eventPosition).val())=='0' )
			missingScoreAlert = true;
	}
	
	if( missingPlayerAlert && !confirm('ATENÇÃO!\n\nAlgumas posições não foram definidas!\nDeseja salvar o resultado desta forma?') )
		return;
	
	if( !missingPlayerAlert && missingScoreAlert && !confirm('ATENÇÃO!\n\nAlguns jogadores não tiveram a pontuação definida!\nDeseja salvar o resultado desta forma?') )
		return;

	if( _eventLiveConfirmSaveResult && !confirm('CONFIRMAÇÃO!\n\nConfirma a publicação do resultado deste evento?') )
		return;
	
	_eventLiveConfirmSaveResult = false;
	
	showIndicator();
	
	var successFunc = function(t){
		
		var content = t.responseText;
		
		hideIndicator();
	}
	
	var failureFunc = function(t){
		
		hideIndicator();
		
		var errorMessage = parseMessage(t.responseText);
		errorMessage = (errorMessage?errorMessage:'\nPor favor, tente novamente.');
		
		alert('Não foi possível salvar o resultado do evento!\n'+errorMessage);
		
		if( isDebug() )
			debug(t.responseText);
	}
	
	$('#eventLiveResultPublish').val('1');
	$('#eventLiveResultForm').submit();
}

function getEventLivePlayers(){

	return $('#statsPlayersConfirm').html().replace(/[^0-9]/ig, '')*1;
}

function loadDefaultValues(rankingLiveId){
	
	if( !rankingLiveId )
		return;

	var successFunc = function(content){
		
		var infoObj = parseInfo(content);
		
		$('#eventLiveStartTime').val(infoObj.startTime);
		$('#eventLiveIsFreeroll').prop('checked', infoObj.isFreeroll);
		$('#eventLiveBuyin').val(toCurrency(infoObj.buyin));
		$('#eventLiveEntranceFee').val(toCurrency(infoObj.entranceFee));
		$('#eventLiveBlindTime').val(infoObj.blindTime);
		$('#eventLiveStackChips').val(infoObj.stackChips);
		$('#eventLiveAllowedRebuys').val(infoObj.allowedRebuys);
		$('#eventLiveAllowedAddons').val(infoObj.allowedAddons);
		$('#eventLiveTablesNumber').val(infoObj.tablesNumber);
		$('#eventLivePrizeSplit').val(infoObj.prizeSplit);
		$('#eventLiveRakePercent').val(infoObj.rakePercent);
		$('#eventLiveIsIlimitedRebuys').prop('checked', infoObj.isIlimitedRebuys);
		$('#eventLivePublishPrize').prop('checked', infoObj.publishPrize);
		
		handleIsFreeroll(infoObj.isFreeroll)
		
		$.uniform.update();
	}
	
	var failureFunc = function(t){
		
		if( isDebug() )
			debug(t.responseText);
	}
	
	var urlAjax = _webRoot+'/rankingLive/getInfo/rankingLiveId/'+rankingLiveId;
	AjaxRequest(urlAjax, {asynchronous:true, evalScripts:false, onFailure:failureFunc, onSuccess:successFunc});
}

function loadEventStats(){
	
	var eventLiveId   = $('#eventLiveId').val();
	var rankingLiveId = $('#eventLiveRankingLiveId').val();
	var eventDate     = $('#eventLiveEventDate').val();
	
	if( !eventLiveId || !rankingLiveId || !eventDate )
		return;
	
	var successFunc = function(content){
		
		var infoObj = parseInfo(content);
		
		$('#previousBalanceAmount').html(infoObj.balance.previous);
		
		$('#statsPlayersPrevious').html(infoObj.players.previous);
		$('#statsPlayersConfirmPrevious').html(infoObj.playersConfirm.previous);
		updateEventLiveStats();
	}
	
	var failureFunc = function(t){
		
		if( isDebug() )
			debugAdd(t.responseText);
	}
	
	var urlAjax = _webRoot+'/eventLive/getStats';
	urlAjax    += '?eventLiveId='+eventLiveId;
	urlAjax    += '&rankingLiveId='+rankingLiveId;
	urlAjax    += '&eventDate='+eventDate;
	AjaxRequest(urlAjax, {asynchronous:true, evalScripts:false, onFailure:failureFunc, onSuccess:successFunc});
}

function calculateEventLiveScore(){
	
	if( !$('#eventLivePrizeSplit').val() ){
		
		$('#eventLivePrizeSplit').focus();
		return addFormError('eventLive', 'prizeSplit', 'Informe a divisão do prêmio');
	}else
		removeFormError('eventLive', 'prizeSplit');
	
	showIndicator();
	
	var successFunc = function(content){
		
		var infoObj = parseInfo(content);
		
		if( infoObj==null )
			return failureFunc(content);
		
		var players = infoObj.players;
		
		for(var eventPosition=1; eventPosition <= players; eventPosition++){
			
			var score = infoObj[eventPosition].score;
			var prize = infoObj[eventPosition].prize;
			
			$('#score-'+eventPosition).val(toCurrency(score, 3));
			$('#prize-'+eventPosition).val(toCurrency(prize));
		}
		
		updateTotalPrizeValue();
		
		hideIndicator();
	}
	
	var failureFunc = function(t){
		
		hideIndicator();
		alert('ERRO!\n\nNão foi possível calcular o resultado do evento!\nPor favor, tente novamente.');
		
		if( isDebug() )
			debug(t.responseText?t.responseText:t);
	}
	
	var urlAjax = _webRoot+'/eventLive/calculateResult';
	AjaxRequest(urlAjax, {asynchronous:true, evalScripts:false, onFailure:failureFunc, onSuccess:successFunc, parameters:$('#eventLiveResultForm').serialize()});
}

function setupEventLiveResultAutoComplete(){
	
	var eventLiveId = $('#eventLiveId').val();
	
	var urlAjax = _webRoot+'/eventLive/autoComplete/instanceName/player/eventLiveId/'+eventLiveId;
	
    $('.autocompletePlayer').autocomplete({
        source: function(request, response) {
			
            $.ajax({
                url: urlAjax,
                data: request,
                dataType: 'json',
                success: function(data) {
                    response(data);
                },
                error: function(data) {
                	
                },
            });
        },
        select: function(event, ui) { 
        	
        	var eventPosition = this.id.replace('eventLivePeopleNameResult-', '')*1;
        	handleSelectEventLivePlayerResult(ui.item.id, ui.item.value, eventPosition);
        },
        autoFocus: true
    });
}

function doSelectEventLivePlayer(id, value){

	handleSelectEventLivePlayer(id, value, 'eventLive', 'peopleId', {searchFieldName:'eventLivePeopleName', quickModuleName:'people'})
}

function removeEventLivePhoto(eventLivePhotoId){

	var successFunc = function(t){

		$('#eventLivePhoto-'+eventLivePhotoId).remove();
	};
		
	var failureFunc = function(t){

		var content = t.responseText;

		alert('Não foi possível remover a foto selecionada!\nPor favor, tente novamente.');
		
		if( !errorMessage && isDebug() )
			debug(content);
	};
	
	var urlAjax = _webRoot+'/eventLive/deletePhoto?eventLivePhotoId='+eventLivePhotoId;
	AjaxRequest(urlAjax, {asynchronous:true, evalScripts:false, onSuccess:successFunc, onFailure:failureFunc});
}

function updatePrizeSplitLabel(){
	
	var splitValue = $('#eventLivePrizeSplit').val();
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

function updateTotalPrizeValue(){
	
	var totalPrizeValue = 0;
	for(var eventPosition=1; eventPosition <= getEventLivePlayers(); eventPosition++)
		totalPrizeValue += toFloat($('#prize-'+eventPosition).val());
	
	$('#totalPrizeValue').html(toCurrency(totalPrizeValue));
}

function activeResultTab(){
	
	$('#resultTab').find('ul.tabs li:first').addClass('activeTab').show(); // Activate
																			// first
																			// tab
	$('#resultTab').find('.tab_content:first').show(); // Show first tab
														// content
	
	return false;
}

function updateEventLivePhotoList(){
	
	var eventLiveId = $('#eventLiveId').val();
	
	var successFunc = function(content){
		
		$('#eventLivePhotoListDiv').html(content);
		
		buildEventLiveLightbox();
		
		hideIndicator();
	};
		
	var failureFunc = function(t){

		var content = t.responseText;

		hideIndicator();
		alert('Não foi possível recarregar a listagem de fotos!\nPor favor, recarregue a página para visualizar as fotos carregadas.');
		
		if( isDebug() )
			debug(content);
	};

	showIndicator();

	var urlAjax = _webRoot+'/eventLive/getPhotoList?eventLiveId='+eventLiveId;

	AjaxRequest(urlAjax, {asynchronous:true, evalScripts:false, onSuccess:successFunc, onFailure:failureFunc});
}

function buildEventLiveLightbox(){
	
	$('.photoList a.lightbox').lightBox();
}

function eventLiveFacebookShare(){
	
	var eventLiveId = $('#eventLiveId').val();
	
	var form = document.createElement('form');
	
	form.target = '_blank';
	form.method = 'POST';
	form.action = _webRoot+'/eventLive/facebookShare';
	
	document.body.appendChild( form );
	
	var postParam  = document.createElement('input');
	postParam.type  = 'hidden';
	postParam.name  = 'eventLiveId';
	postParam.value = eventLiveId;

	form.appendChild( postParam );
	form.submit();	
}

function updateEventPlayerTable(){
	
	showIndicator();
	
	var eventLiveId = $('#eventLiveId').val();
	
	var successFunc = function(content){
		
		hideIndicator();
		
		$('#eventLivePlayerIdTbody').html(content);
	}

	var failureFunc = function(t){
		
		hideIndicator();
		
		alert('Ocorreu um erro ao recarregar a aba Jogadores!\nPor favor, atualize a página caso queira lançar o resultado do evento.');
		
		if( isDebug() )
			debug(t.responseText);
	}
	
	var urlAjax = _webRoot+'/eventLive/getPlayerList/eventLiveId/'+eventLiveId;
	AjaxRequest(urlAjax, {asynchronous:true, evalScripts:false, onFailure:failureFunc, onSuccess:successFunc});
}

function updateEventPlayerResultTable(){
	
	showIndicator();
	
	var eventLiveId = $('#eventLiveId').val();
	
	var successFunc = function(content){
		
		hideIndicator();
		
		$('#eventLiveResultTbody').html(content);
		setupEventLiveResultAutoComplete();
		redips_init(); // Reinstancia o método para poder reordenar as linhas
		// do resultado com drag and drop
	}
	
	var failureFunc = function(t){
		
		hideIndicator();
		
		alert('Ocorreu um erro ao recarregar a aba Resultado!\nPor favor, atualize a página caso queira lançar o resultado do evento.');
		
		if( isDebug() )
			debug(t.responseText);
	}
	
	var urlAjax = _webRoot+'/eventLive/getResultPlayerList/eventLiveId/'+eventLiveId;
	AjaxRequest(urlAjax, {asynchronous:true, evalScripts:false, onFailure:failureFunc, onSuccess:successFunc});
}

function updateMainBalanceByEventLive(){
	
	var players = getEventLivePlayers();
	
	if( players > 0 ){
		
		var totalRebuys      = toFloat($('#eventLiveTotalRebuys').val());
		var totalBuyin       = toFloat($('#eventLiveBuyin').val());
		var totalEntranceFee = toFloat($('#eventLiveEntranceFee').val());
		var totalValue       = totalRebuys+((totalBuyin+totalEntranceFee)*players);
	}else{
		
		var totalValue = 0
	}
	
	var previousBalance = toFloat($('#previousBalanceAmount').html());
	
	if( !previousBalance )
		var percent = 0;
	else
		var percent = ((totalValue-previousBalance)*100/(previousBalance?previousBalance:1));
	
	updateMainBalanceChanges(percent);
	updateMainBalance(totalValue);
}

function updateEventLiveStats(content){
	
	var eventLiveId = $('#eventLiveId').val();
	
	var successFunc = function(content){
		
		var playerInfoObj = parseInfo(content)
		
		var players                = playerInfoObj.players.value;
		var playersConfirm         = playerInfoObj.playersConfirm.value;
		var playersPrevious        = playerInfoObj.players.previous;
		var playersConfirmPrevious = playerInfoObj.playersConfirm.previous;

		$('#statsPlayers').html(players);
		var percent = playerInfoObj.players.changes
		$('#statsPlayersPercent').html(toCurrency(Math.abs(percent), 0)+'%');
		$('#statsPlayersPercent').attr('class', (percent>0?'roundPos':(percent<0?'roundNeg':'roundZero')));
		
		$('#statsPlayersConfirm').html(playersConfirm);
		percent = playerInfoObj.playersConfirm.changes
		$('#statsPlayersConfirmPercent').html(toCurrency(Math.abs(percent), 0)+'%');
		$('#statsPlayersConfirmPercent').attr('class', (percent>0?'roundPos':(percent<0?'roundNeg':'roundZero')));
		
		updateMainBalanceChanges(playerInfoObj.balance.changes);
		updateMainBalance(playerInfoObj.balance.value);
	}
	
	if( content )
		return successFunc(content);

	var failureFunc = function(t){
		
		if( isDebug() )
			debug(t.responseText);
	}
	
	var urlAjax = _webRoot+'/eventLive/getEventStats/eventLiveId/'+eventLiveId;
	AjaxRequest(urlAjax, {asynchronous:true, evalScripts:false, onFailure:failureFunc, onSuccess:successFunc});
}

function loadDisclosureTab(){
	
	var eventLiveId = $('#eventLiveId').val();
	
	loadTabContent('tab6', '/eventLive/getTabContent/tabName/disclosure/eventLiveId/'+eventLiveId, false, uniformUpdate)
}

function uniformUpdate(){
	
	buildCheckboxTable();
	$('#emailSenderOptionsDiv select').uniform();
	$('#tab6 input:checkbox').uniform();
}

function saveEmailTemplate(emailTemplateId){
	
	var eventLiveId = $('#eventLiveId').val();
	
	var successFunc = function(content){
		
	}

	var failureFunc = function(t){
		
	}
	
	var urlAjax = _webRoot+'/eventLive/saveEmailTemplate/eventLiveId/'+eventLiveId+'/emailTemplateId/'+emailTemplateId;
	AjaxRequest(urlAjax, {asynchronous:true, evalScripts:false, onFailure:failureFunc, onSuccess:successFunc});
}

function handleSuppressSchedule(checked){
	
	$('#eventLiveScheduleStartDate').attr('disabled', checked);
}

function buildEventLiveResultPdf(){
	
	var eventLiveId = $('#eventLiveId').val();
	var urlAjax = _webRoot+'/eventLive/buildResultPdf/eventLiveId/'+eventLiveId;
	window.location = urlAjax;
}

function toggleEventLiveMode(enrollmentMode){
	
	$('#eventLiveEnrollmentModeDiv .blackB').addClass('basic');
	$('#eventLiveEnrollmentModeDiv .blackB').removeClass('blackB');
	
	$('#eventLiveEnrollmentModeEnrollmentImage').hide();
	$('#eventLiveEnrollmentModeConfirmationImage').hide();
	$('#eventLiveEnrollmentModeEliminationImage').hide();
	
	$('#eventLiveEnrollmentMode'+ucfirst(enrollmentMode)+'Button').addClass('blackB');
	$('#eventLiveEnrollmentMode'+ucfirst(enrollmentMode)+'Image').show();
	
	var eventLiveId = $('#eventLiveId').val();
	$('#eventLiveEnrollmentMode').val(enrollmentMode);
	
	if( enrollmentMode=='elimination' )
		$('#eventLivePlayerEliminationFields').show();
	else
		$('#eventLivePlayerEliminationFields').hide();
	
	var urlAjax = _webRoot+'/eventLive/toggleEnrollmentMode/eventLiveId/'+eventLiveId+'/enrollmentMode/'+enrollmentMode;
	AjaxRequest(urlAjax, {asynchronous:true, evalScripts:false});
}

function editPlayerInfoEventLive(peopleId){
	
	handleSuccessPeopleQuickEdit = function(content){
		
		var peopleObj = parseInfo(content);
		
		$('#eventLivePlayer-peopleName-'+peopleObj.id).html(peopleObj.fullName);
		$('#eventLivePlayer-emailAddress-'+peopleObj.id).html(peopleObj.emailAddress);
		
		closePeopleQuickEditDialog();
		hideIndicator();
	}
	
	quickEditPeople(peopleId);
}

function addStepDay(){
	
	var index = $('#eventLiveStepDayCurrentIndex').val();
	++index;
	
	var actionButton = '<a href="javascript:void(0)" onclick="removeStepDay('+index+')" ><img src="'+_imageRoot+'/backend/icons/color/cross.png" title="Excluir dia" class="mt7"/></a>';

	if( index==0 )
		actionButton = '<a href="javascript:void(0)" onclick="addStepDay()" ><img src="'+_imageRoot+'/backend/icons/color/plus.png" title="Adicionar dia" class="mt7"/></a>';
	
	var html = '<div class="clear mt6"></div>'+
			   '<div id="eventLiveStepDayRow-'+index+'">'+
			   '	<span class="multi"><input name="stepDay[]" id="eventLiveStepDay" value="" size="5" maxlength="5" autocomplete="off" type="text"></span>'+
			   '	<span class="multi"><input name="stepEventDate[]" id="eventLiveStepEventDate-'+index+'" value="" maxlength="10" class="stepEventDate maskDate" autocomplete="off" type="text"></span>'+
			   '	<span class="multi"><input name="stepStartTime[]" value="" size="5" maxlength="5" onkeyup="maskTime(event)" autocomplete="off" type="text"></span>'+
			   '	<span class="multi">'+actionButton+'</span>'+
			   '	<div class="clear"></div>';
			   '</div>';
	
	var divElement = document.createElement('div');
	divElement.innerHTML = html;

	$('#eventLiveStepDayListDiv').append( divElement );
	$('#eventLiveStepDayCurrentIndex').val(index);
	
	updateEventLiveStepDatePicker();
}

function removeStepDay(index){
	
	$('#eventLiveStepDayRow-'+index).remove();
}