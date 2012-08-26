function doLogin(){
	
	showIndicator();
	disableButton('loginSubmit');
	$('loginForm').onsubmit();
}

function handleSuccessLogin(content){

	goToPage('myAccount', 'index');
}

function handleFailureLogin(content){

	enableButton('loginSubmit');
	hideIndicator();
	showDiv('loginErrorMessage')
}

function togglePasswordRecovery(){
	
	$('loginArea').addClassName('hidden');
	$('passwordRecoveryArea').removeClassName('hidden');
	$('loginTitle').innerHTML = 'Recuperação de senha';
	
	$('resetPasswordEmailAddress').focus();
}

function toggleLogin(){
	
	$('loginArea').removeClassName('hidden');
	$('passwordRecoveryArea').addClassName('hidden');
	$('loginTitle').innerHTML = 'Usuário existente';
	
	$('loginUsername').focus();
	$('recoveryPasswordLink').remove();
}

function doRecoveryPassword(){
	
	showIndicator();
	disableButton('resetPassword');
	$('resetPasswordForm').onsubmit();
}

function handleSuccessResetPassword(content){

	hideIndicator();
	$('passwordRecoveryArea').addClassName('recoverySuccess');
	$('passwordRecoveryArea').innerHTML = '<span><b>Sua senha foi redefinida com sucesso!</b><br/><br/>Uma mensagem foi enviada ao seu e-mail contendo uma nova senha.<br/><br/>Sugerimos que altere sua senha em seu próximo acesso.<br/><br/><a href="javascript:void(0)" onclick="toggleLogin()">Voltar ao login</a></span>';
}

function handleFailureResetPassword(content){

	enableButton('resetPassword');
	hideIndicator();
	showDiv('resetPasswordErrorMessage');
	
	$('resetPasswordEmailAddress').focus();
	$('resetPasswordEmailAddress').select();
}