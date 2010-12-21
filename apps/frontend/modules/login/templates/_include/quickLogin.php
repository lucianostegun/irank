<div align="center" style="margin-left: 20px; width: 300px; padding: 5px; color: #000000; background: #FFFFFF; border: 1px solid #333">
				Se você já é cadastrado entre com seu usuário e senha
				<div id="quickLoginStatus"></div>
				<table border="0" width="100%" cellspacing="2" cellpadding="0">
					<tr>
						<th>E-mail</th>
						<td colspan="2"><?php echo input_tag('username', null, array('size'=>20, 'maxlength'=>150, 'onkeyup'=>'handleSubmitEnter(event, doQuickLogin)', 'id'=>'loginUsername')) ?></td>
					</tr>
					<tr>
						<th>Senha</th>
						<td colspan="2"><?php echo input_password_tag('password', null, array('size'=>15, 'maxlength'=>15, 'onkeyup'=>'handleSubmitEnter(event, doQuickLogin)', 'id'=>'loginPassword')) ?></td>
					</tr>
					<tr>
						<th><?php echo checkbox_tag('keepLogin', true, true, array('id'=>'loginKeepLogin')) ?></th>
						<td colspan="2"><label for="loginKeepLogin">Manter conectado</label></td>
					</tr>
					<tr>
						<th></th>
						<td>
							<?php echo button_tag('submitLogin', 'Logar', array('onclick'=>'doQuickLogin()')) ?>
						</td>
						<td style="text-align: center; padding-top: 5px">
							<?php echo link_to('Novo cadastro', '/sign') ?>
							<?php echo link_to('Esqueci a senha', '/login/passwordRecovery', array('style'=>'margin-left: 15px')) ?>
						</td>
					</tr>
				</table>
</div>