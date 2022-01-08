function saveSmsOption(){
	
	$('smsOptionForm').onsubmit();
}

function handleSuccessSmsOption(content){
	
	setCommonBarMessage('Preferências de notificações SMS salvas com sucesso!', 'info', true);
	hideIndicator();
}

function handleFailureSmsOption(content){
	
	hideIndicator();
	setCommonBarMessage('Ocorreu um erro ao salvar suas preferências de recebimento de SMS! Por favor, tente novamente.', 'error', true);
}

function selectAllSmsOption(checked){
	
	var smsOptionList = document.getElementsByClassName('smsOption');
	
	for(var i=0; i < smsOptionList.length; i++){
		
		smsOptionList[i].checked = checked;
		
		if( checked )
			smsOptionList[i].addClassName('checked');
		else
			smsOptionList[i].removeClassName('checked');
	}
}

function checkSmsOptionAll(Element){
	
	if( Element.checked )
		Element.addClassName('checked');
	else
		Element.removeClassName('checked');
		
	var smsOptionList        = document.getElementsByClassName('smsOption');
	var smsOptionCheckedList = document.getElementsByClassName('smsOption checked');
	
	$('smsOptionAll').checked = (smsOptionList.length==smsOptionCheckedList.length);
}