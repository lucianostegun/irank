function handleSuccessSign(content, isNew){
	
	if( isNew )
		goModule('myAccount', false, false, false);

	setButtonBarStatus('signMain', 'success');
	clearFormFieldErrors('signForm');
	showFormStatusSuccess();
	hideIndicator('sign');
	enableButton('mainSubmit');
}

function handleFailureSign(content){
	
	enableButton('mainSubmit');
	setButtonBarStatus('signMain', 'error');
	handleFormFieldError(content, 'signForm', 'sign', false, 'sign')
}

function doSubmitSign(){
	
	showIndicator('sign');
	disableButton('mainSubmit');
	$('signForm').onsubmit();
}