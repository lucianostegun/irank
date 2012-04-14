function handleSuccessUserAdminIndex(content){
	
	if( content ){
		
		var userAdminIdList = content.split(',');
		
		removeTableRows('userAdmin', userAdminIdList);
	}
	
	hideIndicator('userAdmin');
}

function handleFailureUserAdminIndex(content){
	
	hideIndicator('userAdmin');
	var errorMessage = parseMessage(content);
	
	alert('Não foi possível excluir um ou mais registros selecionados!'+errorMessage);
}

function handleSuccessUserAdmin(content){

	showFormStatusSuccess('userAdmin');
	clearFormFieldErrors('userAdmin');
	
	mainRecordName = $('userAdminUserAdminName').value;
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