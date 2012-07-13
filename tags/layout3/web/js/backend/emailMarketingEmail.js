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
	
	var peopleId = peopleIdList[index];
	var percent  = ((100*(index))/peopleIdList.length);

	updateProgressBar(percent, 'progressBarEmail');
	
	if(percent>=100)
		return concludeSendEmail();
	
	$('#emailPeopleListStatusTd-'+peopleId).html('<img src="'+_imageRoot+'/backend/loaders/loader8.gif"/>');
	
	var emailMarketingId = $('#emailMarketingId').val();
	var randomCode       = $('#randomCode'+peopleId).val();
	
	if( typeof(randomCode)=='undefined' )
		randomCode = '';
	
	var urlAjax = _webRoot+'/emailMarketing/sendEmail?peopleId='+peopleId+'&emailMarketingId='+emailMarketingId;
	
	$.ajax({
		type:		'POST',
		url:		_webRoot+'/emailMarketing/sendEmail',
		data: 		'peopleId='+peopleId+'&emailMarketingId='+emailMarketingId+'&randomCode='+randomCode,
		dataType: 	'text',
		success: function(content) {
			
			$('#emailPeopleListStatusTd-'+peopleId).html('<img src="'+_imageRoot+'/backend/icons/notifications/successGreen.png" title="Enviado com sucesso"/>');
			$('#emailPeopleListReadTd-'+peopleId).html('<img src="'+_imageRoot+'/backend/icons/unreadMail.png" title="Sem confirmação de leitura"/>');
			$('#emailPeopleListCreatedAtTd-'+peopleId).html(content);
			$('#randomCodeTd-'+peopleId).html(randomCode);
	    	
			sendEmailItem( peopleIdList, ++index );
		},
		error: function(request, error){

	    	$('#emailPeopleListStatusTd-'+peopleId).html('<img src="'+_imageRoot+'/backend/icons/notifications/exclamation.png"/>');
	    	sendEmailItem( peopleIdList, ++index );
	    	
//	    	if( isDebug() )
//				debug(request.responseText);
		}
	});	
}

function getRandomCode(stringLength){
	
    var text = "";
    var possible = "2A3B4C5D6E7F8G9H2I3J4K5L6M7N8P9Q2R3S4T5U6V7W8X9Y3";

    for( var i=0; i < stringLength; i++ )
        text += possible.charAt(Math.floor(Math.random() * possible.length));

    return text;
}

function buildRandomCodes(){
	
	$("#emailMarketingPeopleListDiv input.randomCode").each(function() {$(this).val(getRandomCode(7));});
}