function handleSuccessContact(content){
	
	clearFormFieldErrors('contactForm');
	showFormStatusSuccess();
	hideIndicator('contact');
	enableButton('mainSubmit');
	
	showDiv('successDiv');
	hideDiv('contactFormDiv');
	hideDiv('contactFormBar');
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
	showDiv('contactFormBar');
	
	$('contactFullName').focus()
}

function showClubTab(element){

	var divId = element.id;
	
	var currentContentDiv = document.getElementsByClassName('clubTabContent active')[0];
	var currentActiveTab  = document.getElementsByClassName('clubTab active')[0];

	if( currentContentDiv.id==divId )
		return false;

	currentContentDiv.removeClassName('active');
	currentActiveTab.removeClassName('active');

	element.addClassName('active');
	$(divId+'Content').addClassName('active');
}

function loadClubTab(element, clubId){
	
	if( element.hasClassName('loaded') )
		return;
	
	var tabId = element.id.replace('club', '');
	
	element.addClassName('loaded');
	
	var completeFunc = function(t){
		
		Lightbox = new Lightbox();
	}
	
	var urlAjax = _webRoot+'/club/getTabContent/tabId/'+tabId+'/clubId/'+clubId
	new Ajax.Updater('club'+tabId+'Content', urlAjax, {asynchronous:true, evalScripts:false, onComplete:completeFunc});
}