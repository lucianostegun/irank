function handleSuccessFeedback(content){
	
	clearFormFieldErrors('feedbackForm');
	showFormStatusSuccess();
	hideIndicator('feedback');
	enableButton('mainSubmit');
	
	showDiv('successDiv');
	hideDiv('feedbackFormDiv');
}

function doSubmitFeedback(){
	
	showIndicator('feedback');
	disableButton('mainSubmit');
	$('feedbackForm').onsubmit();
}

function newMessage(){
	
	$('feedbackForm').reset();
	
	hideDiv('successDiv');
	showDiv('feedbackFormDiv');
	
	$('feedbackFullName').focus()
}