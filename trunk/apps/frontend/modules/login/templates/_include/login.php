<?php
	echo form_remote_tag(array(
		'url'=>'login/login',
		'success'=>'',
		'failure'=>'',
		'encoding'=>'utf8',
		'loading'=>'showIndicator()'
		), array('id'=>'loginForm'));
?>
<div id="login">
	<h1>Login</h1>
	<div style="margin-top: 17px"></div>
	<div class="row">
		<div class="field"><?php echo input_tag('username', null, array('id'=>'loginUsername', 'placeholder'=>'Usuário/E-mail')) ?></div>
	</div>
	<div class="row">
		<div class="field"><?php echo input_password_tag('password', null, array('id'=>'loginPassword', 'placeholder'=>'Senha')) ?></div>
	</div>
	<div class="row">
		<div class="fieldCheckbox"><?php echo checkbox_tag('keepLogin', true, false, array('id'=>'loginKeepLogin')) ?></div>
		<div class="label"><label for="loginKeepLogin">Manter logado</label></div>
		<div class="button"><?php echo button_tag('doLogin', 'Entrar', array()) ?></div>
	</div>
	<div class="separator"></div>
	<div class="links">
		<?php echo link_to('esqueceu a senha?', '#retrievePassword()') ?>
		<?php echo link_to('cadastrar', 'sign/index', array('class'=>'last')) ?>
	</div>
</div>
</form>
<?php sfContext::getInstance()->getResponse()->addStylesheet('frontend/login'); ?>
<?php sfContext::getInstance()->getResponse()->addJavascript('frontend/login'); ?>