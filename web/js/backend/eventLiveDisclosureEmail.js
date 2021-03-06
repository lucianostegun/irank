function showEventLiveEmailOptions(){

	hideDiv('disclosureMenuShareDiv');
	showDiv('emailSenderOptionsDiv');
}

function hideEventLiveEmailOptions(){
	
	showDiv('disclosureMenuShareDiv');
	hideDiv('emailSenderOptionsDiv');
}

function sendEmailToSelectedPlayers(){
	
	var emailTemplateId = $('#eventLiveEmailTemplateId').val();
	
	if( !emailTemplateId )
		return alert('Nenhum template de e-mail foi definido para o envio do e-mail!\nPor favor, selecione um dos templates disponíveis');
		
	var peopleIdList = new Array();
	$("#emailSenderOptionsDiv input.peopleId:checked").each(function() {peopleIdList.push($(this).val());});
	 
	if (peopleIdList.length == 0)
	    return alert("Nenhum jogador foi selecionado!\nPor favor, selecione pelo menos um jogador para enviar o e-mail.");

	if( !confirm('Confirma o envio do e-mail de divulgação do evento para todos os jogadores selecionados?\nTotal de jogadores selecionados: '+peopleIdList.length) )
		return;

	showDiv('emailSenderProgressBarDiv');
	
	sendEmailItem( peopleIdList, 0 );
}

function concludeSendEmail(){
	
	hideDiv('emailSenderProgressBarDiv');
	alert('E-mails enviados com sucesso.\nVerifique na lista abaixo o resultado de envio e o relatório de leitura dos e-mails.');
}

function sendEmailItem( peopleIdList, index ){
	
	var percent = ((100*(index))/peopleIdList.length);

	updateProgressBar(percent, 'progressBarEmail');
	
	if(percent>=100)
		return concludeSendEmail();
	
	$('#emailPeopleListStatusTd-'+peopleIdList[index]).html('<img src="'+_imageRoot+'/backend/loaders/loader8.gif"/>');
	
	var eventLiveId = $('#eventLiveId').val();
	
	$.ajax({
		type:		'POST',
		url:		_webRoot+'/eventLive/sendDiclosureEmail',
		data: 		'peopleId='+peopleIdList[index]+'&eventLiveId='+eventLiveId,
		dataType: 	'text',
		success: function (request) {
			
			$('#emailPeopleListStatusTd-'+peopleIdList[index]).html('<img src="'+_imageRoot+'/backend/icons/notifications/successGreen.png" title="Enviado com sucesso"/>');
			$('#emailPeopleListReadTd-'+peopleIdList[index]).html('<img src="'+_imageRoot+'/backend/icons/unreadMail.png" title="Sem confirmação de leitura"/>');
			$('#emailPeopleListCreatedAtTd-'+peopleIdList[index]).html(request);
	    	
			sendEmailItem( peopleIdList, ++index );
		},
		error: function(request,error){

	    	$('#emailPeopleListStatusTd-'+peopleIdList[index]).html('<img src="'+_imageRoot+'/backend/icons/notifications/exclamation.png"/>');
//	    	alert('E1'+request.responseText);
//	    	alert('E2'+error);
	    	sendEmailItem( peopleIdList, ++index );
		}
	});	
}