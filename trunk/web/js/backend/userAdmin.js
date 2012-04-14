function handleSuccessUserAdminIndex(content){
	
	if( content ){
		
		var userAdminIdList = content.split(',');
		
		removeTableRows('userAdmin', userAdminIdList);
	}
	
	hideIndicator();
}

function handleFailureUserAdminIndex(content){
	
	hideIndicator();
	var errorMessage = parseMessage(content);
	
	alert('Não foi possível excluir um ou mais registros selecionados!'+errorMessage);
}

function handleSuccessUserAdmin(content){

	showFormStatusSuccess();
	clearFormFieldErrors();
	
	mainRecordName = $('#userAdminUserAdminName').val();
	updateMainRecordName(mainRecordName, true);
}

function handleFailureUserAdmin(content){
	
	handleFormFieldError(content, 'userAdmin');
}

function togglePasswordField(){
	
	$('#userAdminPassword').val('');
	$('#userAdminNewPassword').val('');
	$('#userAdminPasswordConfirm').val('');

	showDiv('passwordFieldDiv');
	hideDiv('passwordRoDiv');
	
	$('#userAdminNewPassword').focus();
}