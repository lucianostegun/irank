function handleSuccessSettings(content){

	clearFormFieldErrors();
	showFormStatusSuccess();
}

function handleFailureSettings(content){
	
	handleFormFieldError(content, 'settings');
}

function showTags(instanceName){
	
	$('#'+instanceName+'TemplateTags').show(function(){ //fade
		$(this).slideDown(300);
	});

	$('#hide'+ucfirst(instanceName)+'TagsLink').show();
	$('#show'+ucfirst(instanceName)+'TagsLink').hide();
}

function hideTags(instanceName){
	
	$('#'+instanceName+'TemplateTags').hide(function(){ //fade
		$(this).slideUp(300);
	});
	
	$('#hide'+ucfirst(instanceName)+'TagsLink').hide();
	$('#show'+ucfirst(instanceName)+'TagsLink').show();
}