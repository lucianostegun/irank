function handleFailureUserToolsIndex(content){
	
	hideIndicator();
	var errorMessage = parseMessage(content);
	
	alert('Não foi possível excluir um ou mais registros selecionados!'+errorMessage);
}

function handleSuccessUserTools(content){

	showFormStatusSuccess();
	clearFormFieldErrors();
	
	mainRecordName = $('#userToolsPeopleName').val();
	updateMainRecordName(mainRecordName, true);
}

function handleFailureUserTools(content){
	
	handleFormFieldError(content, 'userTools');
}

function togglePasswordField(){
	
	$('#userToolsPassword').val('');
	$('#userToolsNewPassword').val('');
	$('#userToolsPasswordConfirm').val('');

	showDiv('passwordFieldDiv');
	hideDiv('passwordRoDiv');
	
	$('#userToolsNewPassword').focus();
}