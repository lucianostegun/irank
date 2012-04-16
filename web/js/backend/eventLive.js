function handleSuccessEventLive(content){

	showFormStatusSuccess();
	clearFormFieldErrors();
	
	mainRecordName = ($('#eventLiveEventShortName').val()?$('#eventLiveEventShortName').val():$('#eventLiveEventName').val());
	updateMainRecordName(mainRecordName, true);
	
	$('#eventLiveResultForm').submit();
}

function handleFailureEventLive(content){
	
	handleFormFieldError(content, 'eventLive');
}

function handleSuccessEventLiveResult(content){
	
	hideIndicator();
}

function handleFailureEventLiveResult(content){
	
	hideIndicator();
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
	
	$('#eventLiveAllowedRebuys').disabled = checked;
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
	
	var successFunc = function(t){

		var peopleId = t.responseText;
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
	$('#eventLiveResultPublish').val('0');
}

function getEventLivePlayers(){

	return $('#playerCountDiv').html().replace(/[^0-9]/ig, '')*1;
}

function loadDefaultValues(rankingLiveId){
	
	if( !rankingLiveId )
		return;

	var successFunc = function(content){
		
		var infoObj = parseInfo(content);
		
		$('#eventLiveStartTime').val(infoObj.defaultStartTime);
		$('#eventLiveIsFreeroll').prop('checked', infoObj.defaultIsFreeroll);
		$('#eventLiveBuyin').val(toCurrency(infoObj.defaultBuyin));
		$('#eventLiveEntranceFee').val(toCurrency(infoObj.defaultEntranceFee));
		$('#eventLiveBlindTime').val(infoObj.defaultBlindTime);
		$('#eventLiveStackChips').val(infoObj.defaultStackChips);
		$('#eventLiveAllowedRebuys').val(infoObj.defaultAllowedRebuys);
		$('#eventLiveAllowedAddons').val(infoObj.defaultAllowedAddons);
		$('#eventLiveIsIlimitedRebuys').prop('checked', infoObj.defaultIsIlimitedRebuys);
		
		handleIsFreeroll(infoObj.defaultIsFreeroll)
		
		$.uniform.update();
	}
	
	var failureFunc = function(t){
		
		if( isDebug() )
			debug(t.responseText);
	}
	
	var urlAjax = _webRoot+'/rankingLive/getInfo/rankingLiveId/'+rankingLiveId;
	AjaxRequest(urlAjax, {asynchronous:true, evalScripts:false, onFailure:failureFunc, onSuccess:successFunc});
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

function testFunction(id, value){

	handleSelectEventLivePlayer(id, value, "eventLive", "peopleId", {searchFieldName:"eventLivePeopleName", quickModuleName:"people"})
}

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
		]
	});
});