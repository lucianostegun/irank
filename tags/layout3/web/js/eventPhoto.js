function updatePhotoUploadStatus(status){
	
	switch(status){
		case 'error':
			alert(i18n_event_commentsTab_photoUploadError);
			hideIndicator();
			break;
		case 'loading':
			showIndicator();
			break;
		default:
			alert(status)
			break;
	}
}

function updateEventPhotoList(){
	
	var eventId = $('eventId').value;
	
	var successFunc = function(t){

		var content = t.responseText;
		
		$('eventPhotoListDiv').innerHTML = content;
		closeEventPhotoComments();
		adjustContentTab();
		hideIndicator();
	};
		
	var failureFunc = function(t){

		hideIndicator();
	};
	
	var urlAjax = _webRoot+'/event/getPhotoList/eventId/'+eventId;
	new Ajax.Request(urlAjax, {asynchronous:true, evalScripts:false, onSuccess:successFunc, onFailure:failureFunc});
}

function viewEventPhoto(eventPhotoId, direction){
	
	var eventId = $('eventId').value;
	
	var successFunc = function(t){

		var content = t.responseText;
		var fileObj = parseInfo(content);
		
		eventPhotoId = fileObj.id;

		var width  = fileObj.width*1;
		var height = fileObj.height*1;
		
		var content = '<img src="/'+fileObj.filePath+'"/>';
		content += '<a href="javascript:void(0)" onclick="loadEventPhotoComments('+eventPhotoId+')" style="cursor: pointer; position: absolute; right: 0; bottom: 0; z-index: 150"><img src="'+_imageRoot+'/misc/comments32.png" title="'+i18n_event_commentsTab_showPhotoComments+'" />';

		$('eventPhotoDiv').innerHTML = content;

		windowEventPhotoViewShow();
		windowEventPhotoViewObj.setDimension(width+15, height+15);
		windowEventPhotoViewObj.center();
		windowEventPhotoViewShow();
		
		var hidePhotoView = function(){
		
			windowEventPhotoViewHide();
			window.onclick = null;
			window.onkeyup = null;
			document.onclick = null;
			document.onkeyup = null;
		}
		
		var onkeyup = function(event){
			if( !event )
				event = window.event;
			
			if(event.keyCode==37)
				viewEventPhoto(eventPhotoId, 'previous');
			if(event.keyCode==39)
				viewEventPhoto(eventPhotoId, 'next');
			if(event.keyCode==27)
				hidePhotoView();
		}
		
		window.onclick = hidePhotoView;
		window.onkeyup = onkeyup;
		document.onclick = hidePhotoView;
		document.onkeyup = onkeyup;
		
		hideIndicator();
	};
	
	var failureFunc = function(t){

		hideIndicator();
	};

	showIndicator();
	
	var urlAjax = _webRoot+'/event/getPhotoInfo/eventId/'+eventId+'/eventPhotoId/'+eventPhotoId+'/direction/'+direction;
	new Ajax.Request(urlAjax, {asynchronous:true, evalScripts:false, onSuccess:successFunc, onFailure:failureFunc});	
}

function deleteEventPhoto(eventPhotoId){
	
	if( !confirm(i18n_event_commentsTab_photoDeleteConfirm) )
		return false;
	
	var eventId = $('eventId').value;
	
	var successFunc = function(t){

		var content = t.responseText;
		
		$('eventPhotoListDiv').innerHTML = content;
		
		hideIndicator();
	};
	
	var failureFunc = function(t){

		alert(i18n_event_commentsTab_photoDeleteError);
		hideIndicator();
	};

	var urlAjax = _webRoot+'/event/deletePhoto/eventId/'+eventId+'/eventPhotoId/'+eventPhotoId;
	new Ajax.Request(urlAjax, {asynchronous:true, evalScripts:false, onSuccess:successFunc, onFailure:failureFunc});	
}

function confirmPublish(){
	
	var publish = confirm(i18n_event_commentsTab_photoPublishConfirm);
	
	return (publish?'true':'false');
}

function loadEventPhotoComments(eventPhotoId){
	
	myLightbox.end();
	
	var eventId = $('eventId').value;
	
	$('eventPhotoPreviewDiv').innerHTML = '<img width="280" style="height: 210px" src="'+_webRoot+'/event/getPhoto/eventId/'+eventId+'/eventPhotoId/'+eventPhotoId+'/maxWidth/280"/>';
	
	showIndicator();
	putLoading('commentPhotoListDiv');
	
	adjustContentTab();
	
	var successFunc = function(t){

		var content = t.responseText;
		
		$('commentPhotoListDiv').innerHTML = content;
		
		resetCommentForm();

		hideDiv('eventPhotoListDiv');
		hideDiv('commentListDiv');
		showDiv('commentPhotoListDiv');
		showDiv('eventPhotoPreviewDiv');
		showDiv('eventPhotoBackDiv');
		
		$('eventCommentEventPhotoId').value = eventPhotoId;
		
		$('commentTitleDiv').innerHTML = i18n_event_commentsTab_photoIntro;
		
		hideIndicator();
		
		adjustContentTab();
	};
	
	var failureFunc = function(t){

		hideIndicator();
		alert('Não foi possível carregar os comentários da foto!\nPor favor, tente novamente.');
		$('commentPhotoListDiv').innerHTML = '';
	};

	
	var urlAjax = _webRoot+'/event/getPhotoCommentList/eventId/'+eventId+'/eventPhotoId/'+eventPhotoId;
	new Ajax.Request(urlAjax, {asynchronous:true, evalScripts:false, onSuccess:successFunc, onFailure:failureFunc});
}

function closeEventPhotoComments(){
	
	resetCommentForm();

	showDiv('eventPhotoListDiv');
	showDiv('commentListDiv');
	hideDiv('commentPhotoListDiv');
	hideDiv('eventPhotoPreviewDiv');
	hideDiv('eventPhotoBackDiv');
	
	$('eventCommentEventPhotoId').value = '';
	
	$('commentTitleDiv').innerHTML = i18n_event_commentsTab_intro;
	
	adjustContentTab();
}