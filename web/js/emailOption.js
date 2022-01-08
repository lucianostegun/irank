function saveEmailOption(){
	
	$('emailOptionForm').onsubmit();
}

function handleSuccessEmailOption(content){
	
	setCommonBarMessage('Preferências de e-mail salvas com sucesso!', 'info', true);
	hideIndicator();
}

function handleFailureEmailOption(content){
	
	hideIndicator();
	setCommonBarMessage('Ocorreu um erro ao salvar suas preferências de recebimento de e-mail! Por favor, tente novamente.', 'error', true);
}

function selectAllEmailOption(checked){
	
	var emailOptionList = document.getElementsByClassName('emailOption');
	
	for(var i=0; i < emailOptionList.length; i++){
		
		emailOptionList[i].checked = checked;
		
		if( checked )
			emailOptionList[i].addClassName('checked');
		else
			emailOptionList[i].removeClassName('checked');
	}
}

function checkEmailOptionAll(Element){
	
	if( Element.checked )
		Element.addClassName('checked');
	else
		Element.removeClassName('checked');
		
	var emailOptionList        = document.getElementsByClassName('emailOption');
	var emailOptionCheckedList = document.getElementsByClassName('emailOption checked');
	
	$('emailOptionAll').checked = (emailOptionList.length==emailOptionCheckedList.length);
}