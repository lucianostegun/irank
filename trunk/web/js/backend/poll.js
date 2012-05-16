function handleSuccessPoll(content){

	clearFormFieldErrors();
	showFormStatusSuccess();
	
	mainRecordName = $('#pollQuestion').val();
	
	updateMainRecordName(mainRecordName, true);
}

function handleFailurePoll(content){
	
	handleFormFieldError(content, 'poll');
}