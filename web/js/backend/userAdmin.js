function handleSuccessUserAdmin(content){

	showFormStatusSuccess();
	clearFormFieldErrors();
	
	var mainRecordName = $('#userAdminUsername').val();
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

function doSelectUserAdminPeople(peopleId, value){
	
	$('#userAdminPeopleId').val(peopleId);
	
	var successFunc = function(content){
		
		$('#userAdminEmailAddress').val(content);
	}

	var urlAjax = _webRoot+'/people/getEmailAddress/peopleId/'+peopleId;
	AjaxRequest(urlAjax, {asynchronous:true, evalScripts:false, onSuccess:successFunc});
}