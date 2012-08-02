<?php include_partial('home/component/commonBar', array('pathList'=>array(__('accessDenied.title')=>null))); ?>
<div class="moduleIntro">
<?php echo image_tag('block', array('align'=>'left', 'style'=>'margin: 0px 15px 15px 15px')) ?>
			A área que você está tentando acessar é exclusiva a usuários cadastrados!<br/>
			Se você ainda não é cadastrado <?php echo link_to(__('clickHere'), 'sign', array('style'=>'font-weight: bold')) ?> e cadastre-se gratuitamente.<br/><br/>
			Caso você já seja um usuário, informe deus dados de acesso no formulário abaixo.
</div>

<table cellspacing="0" cellpadding="0" class="formTable login" style="width: 350px; float: left; margin-left: 35px">
	<tr>
		<th><h1>Login</h1></th>
	</tr>
	<tr>
		<td valign="top">
			<?php
				echo form_remote_tag(array(
					'url'=>'login/login',
					'success'=>'handleSuccessLogin(request.responseText)',
					'failure'=>'handleFailureLogin(request.responseText)',
					'encoding'=>'UTF8',
					), array('id'=>'loginForm'));
			?>
			<div class="defaultForm">
				<div class="row">
					<div class="labelHalf">Usuário/E-mail</div>
					<div class="field"><?php echo input_tag('username', null, array('id'=>'loginUsername', 'size'=>20)) ?></div>
				</div>
				<div class="row">
					<div class="labelHalf">Senha</div>
					<div class="field"><?php echo input_password_tag('password', null, array('id'=>'loginPassword', 'size'=>20, 'maxlength'=>15)) ?></div>
				</div>
				<div class="row">
					<div class="labelHalf"></div>
					<div class="fieldCheckbox"><?php echo checkbox_tag('keepLogin', true, false, array('id'=>'loginKeepLogin')) ?></div>
					<div class="label"><label for="loginKeepLogin">Manter logado</label></div>
				</div>
				<div class="separator"></div>
				<div class="buttonBarForm login">
					<?php echo button_tag('loginSubmitButton', 'Entrar', array('onclick'=>'doLogin()')) ?>
					<?php echo getFormStatus('login', null, 'Acesso negado!') ?>
				</div>
			</div>
		</td>
	</tr>
</table>
</form>

<?php
	echo form_remote_tag(array(
		'url'=>'login/resetPassword',
		'success'=>'handleSuccessPasswordRecovery(request.responseText)',
		'failure'=>'handleFailurePasswordRecovery(request.responseText)',
		'encoding'=>'utf8',
		'loading'=>'showIndicator()'
		), array( 'id'=>'passwordRecoveryForm' ));
?>
<table cellspacing="0" cellpadding="0" class="formTable" style="width: 350px; float: left; margin-left: 20px" id="passwordRecoveryFormDiv">
	<tr>
		<th><h1>Recuperação de senha</h1></th>
	</tr>
	<tr>
		<td valign="top">
			<div class="defaultForm">
				<div class="row">
				</div>
				<div class="row">
					<div class="labelHalf">E-mail</div>
					<div class="field"><?php echo input_tag('emailAddress', null, array('id'=>'passwordRecoveryEmailAddress', 'size'=>25, 'maxlength'=>100)) ?></div>
				</div>
				<div class="row">
					
				</div>
				<div class="separator"></div>
				<div class="buttonBarForm recoveryPassword">
					<?php echo button_tag('passwordRecovery', 'Redefinir senha', array('onclick'=>'doSubmitPasswordRecovery()')) ?>
					<?php echo getFormStatus(null, 'Senha redefinida', 'Erro ao redefinir a senha') ?>
					<?php echo getFormLoading('passwordRecovery') ?>
				</div>
			</div>						
		</td>
	</tr>
</table>

<table cellspacing="0" cellpadding="0" class="formTable hidden" style="width: 350px; float: left; margin-left: 20px" id="successDiv">
	<tr>
		<th><h1>Senha redefinida com sucesso!</h1></th>
	</tr>
	<tr>
		<td align="left" valign="top" class="message">
			<?php echo __('login.passwordRecovery.successMessage') ?>
		</td>
	</tr>
	<tr>
		<td align="left" valign="top" class="link">
			<div class="separator"></div>
			<?php echo link_to(__('ClickHere'), '/home', array('style'=>'padding-bottom: 5px; background: url(\'/sf/sf_default/images/icons/linkOut16.png\') no-repeat; padding-left: 25px; font-weight: bold')) ?> <?php echo __('homeLink') ?>.<br/>
		</td>
	</tr>
</table>
</form>