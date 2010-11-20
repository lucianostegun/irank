function handleSuccessContact(content){
	
	clearFormFieldErrors('contactForm');
	showFormStatusSuccess();
	hideIndicator('contact');
	enableButton('mainSubmit');
	
	showDiv('successDiv');
	hideDiv('contactFormDiv');
}

function doSubmitContact(){
	
	showIndicator('contact');
	disableButton('mainSubmit');
	$('contactForm').onsubmit();
}

function newMessage(){
	
	$('contactForm').reset();
	
	hideDiv('successDiv');
	showDiv('contactFormDiv');
	
	$('contactFullName').focus()
}