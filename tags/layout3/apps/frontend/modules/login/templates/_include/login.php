<?php
	sfContext::getInstance()->getResponse()->addStylesheet('quickLogin');
	sfContext::getInstance()->getResponse()->addJavascript('quickLogin');
	sfContext::getInstance()->getResponse()->addStylesheet('quickResume');
	
	echo form_remote_tag(array(
		'url'=>'login/login',
		'success'=>'handleSuccessQuickLogin(request.responseText)',
		'failure'=>'handleFailureQuickLogin(request.responseText)',
		'encoding'=>'UTF8',
		), array('id'=>'quickLoginForm'));
?>
<div id="login">
	<h1>Login</h1>
	<div style="margin-top: 17px"></div>
	<div id="loginErrorMessage"><b>Acesso negado!</b><br/>Usuário/Senha inválidos</div>
	<div class="row">
		<div class="field"><?php echo input_tag('username', null, array('id'=>'loginUsername', 'placeholder'=>'Usuário/E-mail')) ?></div>
	</div>
	<div class="row">
		<div class="field"><?php echo input_password_tag('password', null, array('id'=>'loginPassword', 'placeholder'=>'Senha', 'maxlength'=>15)) ?></div>
	</div>
	<div class="row">
		<div class="fieldCheckbox"><?php echo checkbox_tag('keepLogin', true, false, array('id'=>'loginKeepLogin')) ?></div>
		<div class="label"><label for="loginKeepLogin">Manter logado</label></div>
		<div class="button"><?php echo button_tag('doLogin', 'Entrar', array('onclick'=>'doQuickLogin()', 'id'=>'loginSubmitButton')) ?></div>
	</div>
	<div class="separator"></div>
	<div class="links">
		<?php echo link_to('esqueceu a senha?', 'login/passwordRecovery') ?>
		<?php echo link_to('cadastrar', 'sign/index', array('class'=>'last')) ?>
	</div>
</div>
</form>