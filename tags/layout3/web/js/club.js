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

function hoverStar(rating, description){
	
	description = (description?description:'avalie este clube');

	if( rating ){
		
		$('clubRating').addClassName('hover');
		$('clubRating').addClassName('star-'+rating);
	}else{
		
		$('clubRating').removeClassName('hover');
		$('clubRating').removeClassName('star-1');
		$('clubRating').removeClassName('star-2');
		$('clubRating').removeClassName('star-3');
		$('clubRating').removeClassName('star-4');
		$('clubRating').removeClassName('star-5');
		
		var title = $('ratingDescription').title;
		
		if( title ) description = 'Sua avaliação: <b>'+title+'</b>';
	}
	
	$('ratingDescription').innerHTML = description;
}

function rateClub(clubId, rating){
	
	var description = $('ratingDescription').innerHTML;
	description = strip_tags(description.replace('Sua avaliação: ', ''))
	
	var successFunc = function(t){
		
		$('clubRating').className = 'rating-'+rating;
		$('ratingDescription').title     = description;
		$('ratingDescription').innerHTML = 'Sua avaliação: <b>'+description+'</b>';
	}

	var failureFunc = function(t){
		
		alert('É necessário estar logado para classificar o clube!');
	}
	
	var urlAjax = _webRoot+'/club/rate/clubId/'+clubId+'/rating/'+rating
	new Ajax.Request(urlAjax, {asynchronous:true, evalScripts:false, onFailure:failureFunc, onSuccess:successFunc});
}