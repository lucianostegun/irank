function handleSuccessPasswordRecovery(content){
	
	clearFormFieldErrors('passwordRecoveryForm');
	showFormStatusSuccess();
	hideIndicator('passwordRecovery');
	enableButton('mainSubmit');
	
	showDiv('successDiv');
	hideDiv('passwordRecoveryFormDiv');
}

function handleFailurePasswordRecovery(content){

	enableButton('mainSubmit');
	
	handleFormFieldError(content, 'passwordRecoveryForm', 'passwordRecovery', false, 'passwordRecovery');
}

function doSubmitPasswordRecovery(){
	
	showIndicator('passwordRecovery');
	disableButton('mainSubmit');
	$('passwordRecoveryForm').onsubmit();
}