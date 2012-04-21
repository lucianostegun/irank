$(function() {
	
	clearFormFieldErrors();
});



function updateMainRecordName(recordName){
	
	$('#lastPathName').html(recordName)
}

function handleFormFieldError( content, instanceName ){

	if( (/^formError:/).test(content) ){

		showFormStatusError()
		clearFormFieldErrors(instanceName);

		content = content.replace(/^formError:/, '');

		var formErrorObj    = parseInfo(content);
		var fieldNameList   = formErrorObj._fieldNameList
		var fieldErrorCount = formErrorObj._fieldErrorCount

		for(var i=0; i < fieldErrorCount; i++){

		    var fieldName    = fieldNameList[i];
		    var errorMessage = formErrorObj[fieldName];
					    
		    if( (/^\[([a-zA-Z0-9]*)\]/).test(errorMessage) ){
							 	   
		    	var matches = errorMessage.match(/^\[([a-zA-Z0-9]*)\]/)
		    	fieldName   = matches[1];
									 	   
		    	errorMessage = errorMessage.replace(matches[0], '');
		    	errorMessage = errorMessage.replace('form.error.requiredField', 'Este campo é obrigatório e não foi preenchido');
		    	errorMessage = Trim(errorMessage);
		    }

		    if( $('#'+instanceName+'FormError'+ucfirst(fieldName))!=null )
		    	addFormError(instanceName, fieldName, errorMessage)
		}
	}else{
		
		alert('Não foi possível concluir seu cadastro!\nPor favor, tente novamente.');
		
		if( isDebug() )
    	   debug(content)
	}
}

function addFormError(instanceName, fieldName, errorMessage){
	
	$('#'+instanceName+'FormError'+ucfirst(fieldName)).html(errorMessage);
	$('#'+instanceName+'FormError'+ucfirst(fieldName)).show();
   
	$('#'+instanceName+ucfirst(fieldName)).attr('title', errorMessage);
	$('#'+instanceName+ucfirst(fieldName)).addClass('fieldError');
}

function removeFormError(instanceName, fieldName){
	
	$('#'+instanceName+'FormError'+ucfirst(fieldName)).hide();
	$('#'+instanceName+ucfirst(fieldName)).removeClass('fieldError');
}

function clearFormFieldErrors(formId){

	if( !formId )
		formId = getModuleName();
	
	var errorList = $('#'+formId+'Form .formNote.error');
	
	errorList.each(function(index, Element){
		$(Element).hide();
		$(Element).removeClass('fieldError');
	});

	$('#'+formId+'Form .fieldError').removeClass('fieldError');
}

function showFormStatusSuccess(){
	
	$('#formStatusTopMessage').removeClass('error');
	$('#formStatusTopMessage').addClass('success');
	showFormStatusMessage();

	window.setTimeout('hideFormStatusMessage(true)', 4000);
}

function hideFormStatusSuccess(){

	hideFormStatusMessage();
}

function showFormStatusError(){
	
	$('#formStatusTopMessage').removeClass('success');
	$('#formStatusTopMessage').addClass('error');
	showFormStatusMessage();
}

function hideFormStatusError(){
	
	hideFormStatusMessage();
}

function showIndicator(){

	$('#formStatusTopMessage').removeClass('success');
	$('#formStatusTopMessage').removeClass('error');
	$('#formStatusTopMessage').show();
}

function hideIndicator(fade){
	
	hideFormStatusMessage(fade)
}


function showFormStatusMessage(){
	
	$('#formStatusTopMessage').removeClass('hidden');
	
	$('#formStatusTopMessage').fadeTo(200, 1.00, function(){ //fade
		$(this).show(); //then remove from the DOM
	});
}

function hideFormStatusMessage(fade){
	
	if( fade )
		$('#formStatusTopMessage').fadeTo(200, 0.00, function(){ //fade
			$(this).hide(); //then remove from the DOM
		});
	else
		$('#formStatusTopMessage').hide();
}