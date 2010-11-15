function handleSuccessSign(content, isNew){
	
	if( isNew ){

		goModule('sign', 'edit', 'userSiteId', null);
	}

	clearFormFieldErrors('signForm');
	showFormStatusSuccess();
	hideIndicator('sign');
	enableButton('mainSubmit');
}

function doSubmitSign(){
	
	showIndicator('sign');
	disableButton('mainSubmit');
	$('signForm').onsubmit();
}

function togglePasswordField(){
	
	hideDiv('passwordChangeRowDiv');
	
	$('signPassword').value = '';
	$('signPassword').name  = 'passwordOld';
	$('signPassword').id    = 'signPasswordOld';
	
	$('signPasswordConfirm').value = '';
	$('signPasswordConfirm').name  = 'passwordConfirmOld';
	$('signPasswordConfirm').id    = 'signPasswordConfirmOld';
	
	var htmlContent = '';
	
	htmlContent += '<div class="row">';
	htmlContent += '		<div class="label" id="signPasswordLabel">Senha</div>';
	htmlContent += '		<div class="field"><input type="password" name="password" size="15" maxlength="15" class="required" id="signPassword"></div>';
	htmlContent += '		<div class="error" id="signPasswordError" onclick="showFormErrorDetails(\'sign\', \'password\')"></div>';
	htmlContent += '	</div>';
	htmlContent += '	<div class="row">';
	htmlContent += '		<div class="label" id="signPasswordConfirmLabel">Confirmação</div>';
	htmlContent += '		<div class="field"><input type="password" name="passwordConfirm" size="15" maxlength="15" class="required" id="signPasswordConfirm"></div>';
	htmlContent += '		<div class="error" id="signPasswordConfirmError" onclick="showFormErrorDetails(\'sign\', \'passwordConfirm\')"></div>';
	htmlContent += '	</div>';

	$('passwordAreaDiv').innerHTML = htmlContent;
	$('signPasswordConfirm').focus();
}