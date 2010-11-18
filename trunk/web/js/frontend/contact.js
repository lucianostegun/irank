function handleSuccessContact(content){
	
	clearFormFieldErrors('contactForm');
	showFormStatusSuccess();
	hideIndicator('contact');
	enableButton('mainSubmit');
}

function doSubmitContact(){
	
	showIndicator('contact');
	disableButton('mainSubmit');
	$('contactForm').onsubmit();
}