function handleSuccessSettings(content){

	clearFormFieldErrors();
	showFormStatusSuccess();
}

function handleFailureSettings(content){
	
	handleFormFieldError(content, 'settings');
}