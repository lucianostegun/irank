function handleSuccessEventPersonal(content){

	var eventPersonalObj = parseInfo(content);
	
	$('eventPersonalId').value = eventPersonalObj.eventPersonalId;

	setRecordSaved(true);
	clearFormFieldErrors('eventPersonalForm');
	setButtonBarStatus('eventPersonalMain', 'success');
	showFormStatusSuccess();
	
	showDiv('mainMenuEventPersonal');
	
	setLastBarPath($('eventPersonalEventName').value);
	
	adjustContentTab();
	
	enableButton('mainSubmit');
	hideIndicator('eventPersonal');
}

function handleFailureEventPersonal(content){
	
	enableButton('mainSubmit');
	setButtonBarStatus('eventPersonalMain', 'error');
	handleFormFieldError(content, 'eventPersonalForm', 'eventPersonal', false, 'eventPersonal');
}

function doSubmitEventPersonal(content){

	disableButton('mainSubmit');
	
	showIndicator('eventPersonal');
	$('eventPersonalForm').onsubmit();
}

function cloneEventPersonal(){
	
	if( !confirm(i18n_event_cloneConfirm) )
		return false;
	
	var eventPersonalId = $('eventPersonalId').value;
	
	goModule('eventPersonal', 'cloneEvent', 'eventPersonalId', eventPersonalId);
}

function doDeleteEventPersonal(){
	
	if( !confirm(i18n_event_deleteConfirm) )
		return false;
	
	showIndicator('eventPersonal');
	
	disableButton('mainSubmit');
	disableButton('deleteEventPersonal');
	
	var eventPersonalId = $('eventPersonalId').value;
	
	var successFunc = function(t){

		goModule('eventPersonal', 'index')
		hideIndicator('eventPersonal');
	};
		
	var failureFunc = function(t){

		var content = t.responseText;

		hideIndicator('eventPersonal');
		
		enableButton('mainSubmit');
		enableButton('deleteEventPersonal');
		
		var errorMessage = parseMessage(content);
		alert(i18n_event_deleteError+'\n'+(errorMessage?errorMessage:i18n_tryAgain));
		
		if( !errorMessage && isDebug() )
			debug(content);
	};
	
	var urlAjax = _webRoot+'/eventPersonal/delete/eventPersonalId/'+eventPersonalId;
	new Ajax.Request(urlAjax, {asynchronous:true, evalScripts:false, onSuccess:successFunc, onFailure:failureFunc});
}

function doEventPersonalSearch(){
	
	var form = $('eventPersonalSearchForm');
	
	if( isIE() ){
		
		$('isIE').value = true;
		form.submit()
		return false;
	}

	var successFunc = function(t){

		var content = t.responseText;
		$('eventPersonalListContent').innerHTML = content;
		hideIndicator();
	};
		
	var failureFunc = function(t){

		var content = t.responseText;

		hideIndicator();
		
		var errorMessage = parseMessage(content);
		alert(i18n_event_searchError+(errorMessage?'\n'+errorMessage:''));
		
		if( !errorMessage && isDebug() )
			debug(content);
	};
	
	showIndicator();

	var urlAjax = _webRoot+'/eventPersonal/search';
	new Ajax.Request(urlAjax, {asynchronous:true, evalScripts:false, onSuccess:successFunc, onFailure:failureFunc, parameters:Form.serialize(form)});
}