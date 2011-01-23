function handleSuccessMyAccount(content, isNew){
	
	if( isNew )
		goModule('myAccount', null, null, null);

	clearFormFieldErrors('myAccountForm');
	showFormStatusSuccess();
	hideIndicator('myAccount');
	enableButton('mainSubmit');
}

function doSubmitMyAccount(){
	
	showIndicator('myAccount');
	disableButton('mainSubmit');
	$('myAccountForm').onsubmit();
}

function togglePasswordField(){
	
	hideDiv('passwordChangeRowDiv');
	
	$('myAccountPassword').value = '';
	$('myAccountPassword').name  = 'passwordOld';
	$('myAccountPassword').id    = 'myAccountPasswordOld';
	
	$('myAccountPasswordConfirm').value = '';
	$('myAccountPasswordConfirm').name  = 'passwordConfirmOld';
	$('myAccountPasswordConfirm').id    = 'myAccountPasswordConfirmOld';
	
	var htmlContent = '';
	
	htmlContent += '<div class="row">';
	htmlContent += '		<div class="label" id="myAccountPasswordLabel">Senha</div>';
	htmlContent += '		<div class="field"><input type="password" name="password" size="15" maxlength="15" class="required" id="myAccountPassword"></div>';
	htmlContent += '		<div class="error" id="myAccountPasswordError" onclick="showFormErrorDetails(\'myAccount\', \'password\')"></div>';
	htmlContent += '	</div>';
	htmlContent += '	<div class="row">';
	htmlContent += '		<div class="label" id="myAccountPasswordConfirmLabel">Confirmação</div>';
	htmlContent += '		<div class="field"><input type="password" name="passwordConfirm" size="15" maxlength="15" class="required" id="myAccountPasswordConfirm"></div>';
	htmlContent += '		<div class="error" id="myAccountPasswordConfirmError" onclick="showFormErrorDetails(\'myAccount\', \'passwordConfirm\')"></div>';
	htmlContent += '	</div>';

	$('passwordAreaDiv').innerHTML = htmlContent;
	$('myAccountPasswordConfirm').focus();
}