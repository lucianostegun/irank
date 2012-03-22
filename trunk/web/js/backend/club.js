function handleSuccessClub(content){
	
	showFormStatusSuccess()
	clearFormFieldErrors('clubForm');
}

function handleFailureClub(content){
	
	handleFormFieldError(content, 'clubForm', 'club');
}