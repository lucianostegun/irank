<?php include_partial('home/component/commonBar', array('pathList'=>array(__('accessDenied.title')=>null))); ?>
<div class="moduleIntro">
<?php echo image_tag('lock', array('align'=>'left', 'style'=>'margin: 0px 15px 15px 15px')) ?>
			A área que você está tentando acessar é exclusiva a usuários cadastrados!<br/>
			Se você ainda não é cadastrado <?php echo link_to(__('clickHere'), 'sign', array('style'=>'font-weight: bold')) ?> e cadastre-se gratuitamente.<br/><br/>
			Caso você já seja um usuário, informe deus dados de acesso no formulário abaixo.
</div>

<div id="signLoginTable">
	<table cellpadding="5" cellspacing="0">
		<thead>
			<tr>
				<th width="50%" class="border" id="loginTitle"><?php echo ($passwordRecovery?'Recuperação de senha':'Usuário existente') ?></th>
				<th width="50%">Novo usuário</th>
			</tr>
		</thead>
		<tr>
			<td class="border <?php echo ($passwordRecovery?'hidden':'') ?>" valign="top" id="loginArea">
				<?php
					echo form_remote_tag(array(
						'url'=>'login/login',
						'success'=>'handleSuccessLogin(request.responseText, true)',
						'failure'=>'handleFailureLogin(request.responseText)',
						'encoding'=>'UTF8',
						), array('id'=>'loginForm'));
					
					echo input_hidden_tag('redirectUri', $_SERVER['REQUEST_URI']);
				?>
				<table class="quickForm" cellspacing="0" cellpadding="3">
					<tr>
						<td colspan="2" class="pb10">
							Se você ja é usuário do site, informe abaixo seu usuário/e-mail e senha de acesso.
							<div id="loginErrorMessage"><b>Acesso negado!</b> Usuário/Senha inválidos</div>
						</td>
					</tr>
					<tr>
						<th>Usuário/E-mail</th>
						<td><?php echo input_tag('username', null, array('id'=>'loginUsername', 'size'=>20)) ?></td>
					</tr>
					<tr>
						<th>Senha</th>
						<td><?php echo input_password_tag('password', null, array('id'=>'loginPassword', 'size'=>20, 'maxlength'=>15)) ?></td>
					</tr>
					<tr>
						<th class="pt10 nowrap"><?php echo link_to('Recuperar senha', '#togglePasswordRecovery()', array('id'=>'recoveryPasswordLink')) ?></th>
						<td class="pt10 textR"><?php echo submit_image_tag('loginEnter', array('style'=>'border: none; width: 115px; height: 40px')) ?></td>
					</tr>
				</table>
				</form>
			</td>
			<td class="border <?php echo ($passwordRecovery?'':'hidden') ?>" valign="top" id="passwordRecoveryArea">
				<?php
					echo form_remote_tag(array(
						'url'=>'login/resetPassword',
						'success'=>'handleSuccessResetPassword(request.responseText, true)',
						'failure'=>'handleFailureResetPassword(request.responseText)',
						'encoding'=>'UTF8',
						), array('id'=>'resetPasswordForm'));
				?>
				<table class="quickForm" cellspacing="0" cellpadding="3">
					<tr>
						<td colspan="2" class="pb10">
							Se você ja é usuário do site mas não lembra sua senha, informe abaixo seus dados e uma nova senha será enviada ao e-mail cadastrado.
							<div id="resetPasswordErrorMessage"><b>ERRO!</b> E-mail não encontrado</div>
						</td>
					</tr>
					<tr>
						<th>E-mail</th>
						<td><?php echo input_tag('emailAddress', null, array('id'=>'resetPasswordEmailAddress', 'size'=>20)) ?></td>
					</tr>
					<tr>
						<td class="pt20 textR" colspan="2"><?php echo button_tag('resetPassword', 'Recuperar senha', array('onclick'=>'doRecoveryPassword()', 'style'=>'float: right')) ?></td>
					</tr>
				</table>
				</form>
			</td>
			<td valign="top">
				<table class="quickForm" cellspacing="0" cellpadding="3" style="width: 300px">
					<tr>
						<td colspan="2" class="pb10">Ainda não é usuário iRank?<br/>Clique no botão abaixo, cadastre-se gratuitamente e comece agora mesmo a gerenciar seus torneios e seu bankroll.</td>
					</tr>
					<tr>
						<td colspan="2" class="textC"><?php echo link_to(image_tag('store/signUp'), 'sign/index') ?></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	<div class="clear mt400"></div>
</div>