function handleSuccessControlPanel(content){

	showFormStatusSuccess('controlPanel');
	clearFormFieldErrors('controlPanel');
}

function handleFailureControlPanel(content){
	
	handleFormFieldError(content, 'controlPanel');
}