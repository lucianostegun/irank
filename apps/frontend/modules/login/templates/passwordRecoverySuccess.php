<?php
	echo form_remote_tag(array(
		'url'=>'login/resetPassword',
		'success'=>'handleSuccessPasswordRecovery( request.responseText, true )',
		'failure'=>'enableButton("mainSubmit"); handleFormFieldError( request.responseText, "passwordRecoveryForm", "passwordRecovery", false, "passwordRecovery" )',
		'encoding'=>'utf8',
		'loading'=>'showIndicator()'
		), array( 'id'=>'passwordRecoveryForm' ));
?>
<div id="passwordRecoveryFormDiv">
	<?php echo image_tag('recovery', array('align'=>'left', 'style'=>'margin-right: 10px; margin-bottom: 20px')) ?>
		Se você é um usuário cadastrado mas não lembra sua senha<br/>
		utilize o formulário abaixo e informe seu nome de usuário<br/>
		e seu e-mail e você receberá uma mensagem contendo uma nova senha.
		<br/><br/>
		
	<table width="100%" cellspacing="1" cellpadding="0" class="defaultForm" style="border: 1px solid #888A88;">
		<tr>
			<td valign="top">

				<div class="row">
					<div class="label">Username</div>
					<div class="field"><?php echo input_tag('username', null, array('id'=>'passwordRecoveryUsername', 'size'=>20, 'maxlength'=>15)) ?></div>
				</div>
				<div class="row">
					<div class="label">E-mail</div>
					<div class="field"><?php echo input_tag('emailAddress', null, array('id'=>'passwordRecoveryEmailAddress', 'size'=>40, 'maxlength'=>100)) ?></div>
				</div>

			</td>
		</tr>
	</table>
	<div class="buttonBarForm">
		<?php echo button_tag('mainSubmit', 'Redefinir minha senha', array('onclick'=>'doSubmitPasswordRecovery()')) ?>
		<?php echo getFormStatus(null, null, 'Erro ao redefinir sua senha') ?>
		<?php echo getFormLoading('passwordRecovery') ?>
	</div>
</div>
<div id="successDiv" style="display: none">
	<table width="500" border="0" cellspacing="0" cellpadding="0" class="onlinepokerrooms_bg2">
	  <tr>
		<td align="left" valign="middle" class="poker_heading" style="color: #5a5aFF"><?php echo image_tag('frontend/layout/bullet.gif') ?>Senha redefinida com sucesso!</td>
	  </tr>
	  <tr>
	    <td align="left" valign="top" style="padding:15px 23px 16px 20px; color: #333333">
		<?php echo image_tag('frontend/success', array('align'=>'left', 'style'=>'margin: 0 15 15 15')) ?>
		Sua senha foi redefinida com sucesso!<br/>
		Uma mensagem foi enviada ao e-mail informado contendo a nova senha.<br><br>
		Recomendamos que acesse seu e-mail, faça seu login e altere sua senha.<br/>
		na área <b>Cadastro</b> no menu principal.<br/><br/>
		
		<?php echo link_to('clique aqui', '/home', array('style'=>'padding-bottom: 5px; background: url(\'/sf/sf_default/images/icons/linkOut16.png\') no-repeat; padding-left: 25px; font-weight: bold')) ?> para voltar à página inicial<br/>
		</td>
	  </tr>
	</table>
</div>
</form>