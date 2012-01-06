function handleSuccessSign(content, isNew){
	
	if( isNew )
		goModule('myAccount', false, false, false);

	clearFormFieldErrors('signForm');
	showFormStatusSuccess();
	hideIndicator('sign');
	enableButton('mainSubmit');
}

function doSubmitSign(){
	
	showIndicator('sign');
	disableButton('mainSubmit');
	$('signForm').onsubmit();
}