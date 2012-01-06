function handleSuccessPasswordRecovery(content){
	
	clearFormFieldErrors('passwordRecoveryForm');
	showFormStatusSuccess();
	hideIndicator('passwordRecovery');
	enableButton('mainSubmit');
	
	showDiv('successDiv');
	hideDiv('passwordRecoveryFormDiv');
}

function doSubmitPasswordRecovery(){
	
	showIndicator('passwordRecovery');
	disableButton('mainSubmit');
	$('passwordRecoveryForm').onsubmit();
}