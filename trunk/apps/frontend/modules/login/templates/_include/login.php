<div id="login">
	<div class="commonBar"><span>LOGIN</span></div>
	<table cellspacing="2" cellpadding="1" border="0">
		<tr>
			<td colspan="2" id="loginStatus"><b>ACESSO NEGADO</b><br/>Usuário/Senha inválidos!</td>
		</tr>
		<tr>
			<th>Username</th>
			<td class="field"><?php echo input_tag('username', null, array('maxlength'=>15, 'onkeyup'=>'handleSubmitEnter(event, doQuickLogin)', 'id'=>'loginUsername')) ?></td>
		</tr>
		<tr>
			<th>Senha</th>
			<td class="field"><?php echo input_password_tag('password', null, array('maxlength'=>15, 'onkeyup'=>'handleSubmitEnter(event, doQuickLogin)', 'id'=>'loginPassword')) ?></td>
		</tr>
		<tr>
			<td style="text-align: right"><?php echo checkbox_tag('keepLogin', true, true, array('id'=>'loginKeepLogin')) ?></td>
			<th style="text-align: left">Manter conectado</th>
		</tr>
		<tr>
			<th></th>
			<td style="padding-top: 5px"><?php echo button_tag('doLogin', 'Entrar', array('onclick'=>'doQuickLogin()')) ?></td>
		</tr>
		<tr>
			<td style="padding-top: 10px; text-align: center" colspan="2">
				<?php echo link_to('Novo cadastro', 'sign/index') ?>
				<?php echo link_to('Esqueci a senha', 'login/passwordRecovery', array('style'=>'margin-left: 20px')) ?>
			</td>
		</tr>
	</table>
</div>
<?php sfContext::getInstance()->getResponse()->addJavascript( 'frontend/login' ); ?>