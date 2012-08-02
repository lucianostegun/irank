function handleSuccessStore(content){

	clearFormFieldErrors();
	showFormStatusSuccess();
	
	updateMainRecordName(mainRecordName, true);
}

function handleFailureStore(content){
	
	handleFormFieldError(content, 'store');
}