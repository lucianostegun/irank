function handleSuccessControlPanel(content){

	clearFormFieldErrors();
	showFormStatusSuccess();
}

function handleFailureControlPanel(content){
	
	handleFormFieldError(content, 'controlPanel');
}