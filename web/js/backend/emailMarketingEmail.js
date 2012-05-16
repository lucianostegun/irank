function sendEmailToSelectedPlayers(){
	
	var peopleIdList = new Array();
	$("#emailMarketingPeopleListDiv input.peopleId:checked").each(function() {peopleIdList.push($(this).val());});
	 
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
	
	var emailMarketingId = $('#emailMarketingId').val();
	
	var urlAjax = _webRoot+'/emailMarketing/sendEmail?peopleId='+peopleIdList[index]+'&emailMarketingId='+emailMarketingId;
	
	$.ajax({
		type:		'POST',
		url:		_webRoot+'/emailMarketing/sendEmail',
		data: 		'peopleId='+peopleIdList[index]+'&emailMarketingId='+emailMarketingId,
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