$(function() {
	
	var eventLiveId = $('#eventLiveId').val();
	var urlAjax     = _webRoot+'/eventLive/uploadPhotos?eventLiveId='+eventLiveId;
	
	$("#eventLivePhotosUploader").pluploadQueue({
		runtimes : 'html5,html4',
		url : urlAjax,
		max_file_size : '4mb',
		unique_names : true,
		filters : [
			{title : "Arquivos de imagem", extensions : "jpg,png"}
			//{title : "Zip files", extensions : "zip"}
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
	
	if( getActionName()!='index' )
		buildEventLiveLightbox()
});

function handleSuccessEventLive(content){

	clearFormFieldErrors();
	showFormStatusSuccess();
	
	mainRecordName = ($('#eventLiveEventShortName').val()?$('#eventLiveEventShortName').val():$('#eventLiveEventName').val());
	updateMainRecordName(mainRecordName, true);
	
	$('#eventLiveResultForm').submit();
}

function handleFailureEventLive(content){
	
	handleFormFieldError(content, 'eventLive');
}

function handleSuccessEventLiveResult(content){
	
	if( $('#eventLiveResultPublish').val()=='1' )		
		showFormStatusSuccess();
}

function handleFailureEventLiveResult(content){
	
	if( $('#eventLiveResultPublish').val()=='1' ){
		
		hideIndicator();
		alert('Não foi possível salvar o resultado deste evento!\nPor favor, tente novamente.');
	}
}

function replicateEventName(eventName){
	
	if( $('#eventLiveEventShortName').val()!='' )
		return;
	
	eventName = eventName.replace(/ ?-.*Garantidos?/i, '');
	eventName = eventName.replace(/ ?Garantidos?/i, '');
	eventName = eventName.replace(/ ?-.*/, '');
	$('#eventLiveEventShortName').val( eventName.substring(0, 35) );
}

function handleIsIlimitedRebuys(checked){
	
	$('#eventLiveAllowedRebuys').attr('disabled', checked);
}

function handleIsFreeroll(checked){
	
	$('#eventLiveBuyin').attr('disabled', checked);
}

function handleSelectEventLivePlayer(peopleId, peopleName){

	if( peopleId=='quickNew' )
		addQuickNewPlayer(peopleName)
	else
		addPlayer(peopleId);
}

function addQuickNewPlayer(peopleName){
	
	var successFunc = function(content){

		var peopleId = content;
		addPlayer(peopleId);
	};
		
	var failureFunc = function(t){

		var content = t.responseText;

		var errorMessage = parseMessage(content);

		alert('Não foi possível adicionar o novo jogador!\nPor favor, tente novamente.');
		
		if( !errorMessage && isDebug() )
			debug(content);
	};
	
	var urlAjax = _webRoot+'/people/addQuickPlayer?peopleName='+peopleName;
	AjaxRequest(urlAjax, {asynchronous:true, evalScripts:false, onSuccess:successFunc, onFailure:failureFunc});
}

function addPlayer(peopleId){
	
	showIndicator();
	
	var eventLiveId = $('#eventLiveId').val();
	peopleId        = peopleId.replace(/[^0-9]/gi, '');
	
	var successFunc = function(content){
		
		hideIndicator();
		
		if( content=='noChange' ){
			
			$('#eventLivePeopleName').val('Jogador já confirmado no evento');
			$('#eventLivePeopleName').select();
			window.setTimeout('clearEventLivePeopleName()', 3000);
			return;
		}

		$('#eventLivePlayerIdTbody').html(content);
		$('#eventLivePeopleName').val('');
		$('#eventLivePeopleName').focus();
		
		var players = getEventLivePlayers();
		players = (players+1)+' Jogador'+(players==0?'':'es')+' confirmado'+(players==0?'':'s');
		
		$('#playerCountDiv').html( players );
		$('#playerResultCountDiv').html( players );
	}

	var failureFunc = function(t){
		
		hideIndicator();
		
		var errorMessage = parseError(t.responseText);
		errorMessage = (errorMessage?errorMessage:'\nPor favor, tente novamente.');
		
		alert('FALHA NA CONFIRMAÇÃO!\n'+errorMessage);
		
		$('#eventLivePeopleName').focus();
		
		if( isDebug() )
			debug(t.responseText);
	}
	
	var urlAjax = _webRoot+'/eventLive/addPlayer/eventLiveId/'+eventLiveId+'/peopleId/'+peopleId;
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

		$('#playerCountDiv').html( players );
		$('#playerResultCountDiv').html( players );
		
		hideIndicator();
	}
	
	var failureFunc = function(t){
		
		hideIndicator();
		
		var errorMessage = parseError(t.responseText);
		errorMessage = (errorMessage?errorMessage:'\nPor favor, tente novamente.');
		
		alert('Não foi possível remover o jogador do evento!\n'+errorMessage);
		
		if( isDebug() )
			debug(t.responseText);
	}
	
	var urlAjax = _webRoot+'/eventLive/removePlayer/eventLiveId/'+eventLiveId+'/peopleId/'+peopleId;
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
		
		var errorMessage = parseError(t.responseText);
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
	
	for(var eventPosition=1; eventPosition <= players; eventPosition++){
		
		if( $('#peopleIdPosition-'+eventPosition)==null || !$('#peopleIdPosition-'+eventPosition).val() ){
			if( !confirm('ATENÇÃO!\n\nAlgumas posições não foram definidas, deseja realmente continuar?') )
				return;
			
			break;
		}
	}
	
	showIndicator();
	
	var successFunc = function(t){
		
		var content = t.responseText;
		
		hideIndicator();
	}
	
	var failureFunc = function(t){
		
		hideIndicator();
		
		var errorMessage = parseError(t.responseText);
		errorMessage = (errorMessage?errorMessage:'\nPor favor, tente novamente.');
		
		alert('Não foi possível salvar o resultado do evento!\n'+errorMessage);
		
		if( isDebug() )
			debug(t.responseText);
	}
	
	$('#eventLiveResultPublish').val('1');
	$('#eventLiveResultForm').submit();
}

function getEventLivePlayers(){

	return $('#playerCountDiv').html().replace(/[^0-9]/ig, '')*1;
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

function calculateEventLiveScore(){
	
	if( !$('#eventLivePrizeSplit').val() ){
		
		$('#eventLivePrizeSplit').focus();
		return addFormError('eventLive', 'prizeSplit', 'Informe a divisão do prêmio');
	}else
		removeFormError('eventLive', 'prizeSplit');
	
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
	}
	
	var failureFunc = function(t){
		
		alert('ERRO!\n\nNão foi possível calcular o resultado do evento!\nPor favor, tente novamente.');
		
		if( isDebug() )
			debug(t.responseText);
	}
	
	var urlAjax = _webRoot+'/eventLive/calculateResult';
	AjaxRequest(urlAjax, {asynchronous:true, evalScripts:false, onFailure:failureFunc, onSuccess:successFunc, parameters:$('#eventLiveResultForm').serialize()});
}

function calculateEventLiveResult(){

	return alert('O cálculo de resultados ainda não está disponível');
	
	var eventLiveId = $('#eventLiveId').val();
	
	var successFunc = function(t){
		
		var content = t.responseText;
		
		alert(content);
	}
	
	var failureFunc = function(t){
		
		alert('Não foi possível calcular o resultado do evneto!\nPor favor, tente novamente');
		
		if( isDebug() )
			debug(t.responseText);
	}
	
	var urlAjax = _webRoot+'/eventLive/calculateResult/evenLiveId/'+eventLiveId;
	AjaxRequest(urlAjax, {asynchronous:true, evalScripts:false, onFailure:failureFunc, onSuccess:successFunc, parameters:$('#eventLiveResultForm').serialize()});
}

function setupEventLiveResultAutoComplete(){
	
	var eventLiveId = $('#eventLiveId').val();
	
	var urlAjax = _webRoot+'/eventLive/autoComplete/instanceName/player/eventLiveId/'+eventLiveId;
	
    $(".autocompletePlayer").autocomplete({
        source: function(request, response) {
			
            $.ajax({
                url: urlAjax,
                data: request,
                dataType: "json",
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

	handleSelectEventLivePlayer(id, value, "eventLive", "peopleId", {searchFieldName:"eventLivePeopleName", quickModuleName:"people"})
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
	
	$("#resultTab").find("ul.tabs li:first").addClass("activeTab").show(); //Activate first tab
	$("#resultTab").find(".tab_content:first").show(); //Show first tab content
	
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

function eventLiveEmailShare(){

	alert('A opção por email estará disponível em breve');
}

function eventLiveFacebookShare(){
	
	var eventLiveId = $('#eventLiveId').val();
	
	if(!eventLiveId)
		return alert('Salve o evento antes de divulgá-lo');
	
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

function eventLiveTwitterShare(){

	alert('A opção pelo Twitter estará disponível em breve');
}