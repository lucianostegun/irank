function handleSuccessSign(content, isNew){
	
	if( isNew )
		goModule('myAccount', null, null, null);

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