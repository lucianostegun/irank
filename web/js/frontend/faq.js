function handleSuccessFaq(content){
	
	clearFormFieldErrors('faqForm');
	hideIndicator('faq');
	enableButton('mainSubmit');
	
	showDiv('faqSuccessDiv');
	hideDiv('faqFormDiv');
}

function doSubmitFaq(){
	
	showIndicator('faq');
	disableButton('mainSubmit');
	$('faqForm').onsubmit();
}

function toggleFaq(faqId){
	
	if( isVisible('faqAnswer'+faqId))
		hideDiv('faqAnswer'+faqId);
	else
		showDiv('faqAnswer'+faqId);
}

function showQuestionForm(){
	
	$('faqForm').reset();
	clearFormFieldErrors('faqForm');
	hideDiv('sendQuestionTr');
	hideDiv('faqSuccessDiv');
	showDiv('faqFormDiv');
	$('faqQuestion').focus();
}