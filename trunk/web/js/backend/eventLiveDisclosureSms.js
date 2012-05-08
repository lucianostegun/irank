var _peopleIdListSms = [];
function showEventLiveSmsOptions(){
	
	hideDiv('disclosureMenuShareDiv');
	showDiv('smsSenderOptionsDiv');
}

function hideEventLiveSmsOptions(){
	
	showDiv('disclosureMenuShareDiv');
	hideDiv('smsSenderOptionsDiv');
}

function sendSmsToSelectedPlayers(){
	
	var smsMessage = $('#eventLiveTextMessage').val();
	
	if( !smsMessage )
		return addFormError('eventLive', 'textMessage', 'Digite uma mensagem para ser enviada via SMS');
	
	clearFormFieldErrors('eventLiveDisclosureSms');
	
	_peopleIdListSms = new Array();
	$("#smsSenderOptionsDiv input[@name='peopleId[]']:checked").each(function() {_peopleIdListSms.push($(this).val());});
	
	if (_peopleIdListSms.length == 0)
	    return alert("Nenhum jogador foi selecionado!\nPor favor, selecione pelo menos um jogador para enviar a mensagem.");
	
	if( !confirm('Confirma o envio do SMS de divulgação do evento para todos os jogadores selecionados?\nTotal de jogadores selecionados: '+_peopleIdListSms.length) )
		return;

	showDiv('smsSenderProgressBarDiv');
	getSmsToken();
}

function getSmsToken(){
	
	var successFunc = function(content){
		
		var infoObj = parseInfo(content);
		var token   = infoObj.token;
		var smsId   = infoObj.id;
		
		sendSmsItem( _peopleIdListSms, 0, smsId, token );
	};
		
	var failureFunc = function(t){

		var content = t.responseText;

		alert('Não foi possível gerar a chave para envio das mensagens!\nPor favor, tente novamente.');
		
		if( !errorMessage && isDebug() )
			debug(content);
	};
	
	var urlAjax = _webRoot+'/sms/getToken';
	AjaxRequest(urlAjax, {asynchronous:true, evalScripts:false, onSuccess:successFunc, onFailure:failureFunc, parameters:$('#eventLiveDisclosureSmsForm').serialize()});
}

function concludeSendSms(){
	
	updateSmsCreditLabel();
	
	hideDiv('smsSenderProgressBarDiv');
	alert('Mensagens enviados com sucesso.\nVerifique na lista abaixo o resultado de envio e o relatório de leitura das mensagens.');
}

function sendSmsItem( peopleIdList, index, smsId, token ){
	
	var percent = ((100*(index))/peopleIdList.length);

	updateProgressBar( percent );
	
	if(percent>=100)
		return concludeSendSms();
	
	$('#smsPeopleListStatusTd-'+peopleIdList[index]).html('<img src="'+_imageRoot+'/backend/loaders/loader8.gif"/>');
	
	var eventLiveId = $('#eventLiveId').val();
	
	$.ajax({
		type:		'POST',
		url:		_webRoot+'/eventLive/sendDiclosureSms',
		data: 		'peopleId='+peopleIdList[index]+'&eventLiveId='+eventLiveId+'&smsId='+smsId+'&token='+token,
		dataType: 	'text',
		success: function (request) {
			
			$('#smsPeopleListStatusTd-'+peopleIdList[index]).html('<img src="'+_imageRoot+'/backend/icons/notifications/successGreen.png" title="Enviado com sucesso"/>');
			$('#smsPeopleListCreatedAtTd-'+peopleIdList[index]).html(request);
	    	
			sendSmsItem( peopleIdList, ++index, smsId, token );
		},
		error: function(request, error){
			
	    	$('#smsPeopleListStatusTd-'+peopleIdList[index]).html('<img src="'+_imageRoot+'/backend/icons/notifications/exclamation.png" title="'+request.responseText+'" />');
	    	
	    	if( isDebug() )
	    		debugAdd(request.responseText);
	    	
	    	sendSmsItem( peopleIdList, ++index, smsId, token );
		}
	});	
}

function updateSmsCharCount(){
	
	var charLimit  = 140;
	var smsMessage = $('#eventLiveTextMessage').val();
	
	var charsLeft = charLimit-smsMessage.length;
	
	if( charsLeft < 0 ){

		charsLeft = 0;
		$('#eventLiveTextMessage').val(smsMessage.substring(0,140));
	}
	
	if( charsLeft==1 )
		$('#eventLiveSmsCharCountLabel').html('caracter restante');
	else
		$('#eventLiveSmsCharCountLabel').html('caracteres restantes');
	
	$('#eventLiveSmsCharCount').html(charsLeft);
}

function updateSmsCreditLabel(){
	
	var successFunc = function(content){
		
		$('#smsCredit').html(content);
		
		if( content*1==1 )
			$('#smsCreditMessages').html('mensagem');
		else
			$('#smsCreditMessages').html('mensagens');
	};
		
	var failureFunc = function(t){

		var content = t.responseText;

		if( !errorMessage && isDebug() )
			debug(content);
	};
	
	var urlAjax = _webRoot+'/sms/getCredit';
	AjaxRequest(urlAjax, {asynchronous:true, evalScripts:false, onSuccess:successFunc, onFailure:failureFunc});
}