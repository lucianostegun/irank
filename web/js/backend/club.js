function handleSuccessClubIndex(content){
	
	if( content ){
		
		var clubIdList = content.split(',');
		
		removeTableRows('club', clubIdList);
	}
	
	hideIndicator('club');
}

function handleFailureClubIndex(content){
	
	hideIndicator('club');
	var errorMessage = parseMessage(content);
	
	alert('Não foi possível excluir um ou mais registros selecionados!'+errorMessage);
}

function handleSuccessClub(content){

	showFormStatusSuccess('club');
	clearFormFieldErrors('club');
	
	mainRecordName = $('clubClubName').value;
	updateMainRecordName(mainRecordName, true);
}

function handleFailureClub(content){
	
	handleFormFieldError(content, 'club');
}