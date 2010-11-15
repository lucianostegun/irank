				Se você já é cadastrado entre com seu usuário e senha
				<div id="quickLoginStatus"></div>
				<table border="0" width="100%" cellspacing="2" cellpadding="0">
					<tr>
						<th>E-mail</th>
						<td colspan="2"><?php echo input_tag('username', 'lstegun', array('size'=>20, 'maxlength'=>150, 'id'=>'loginUsername')) ?></td>
					</tr>
					<tr>
						<th>Senha</th>
						<td colspan="2"><?php echo input_password_tag('password', 'unidunite', array('size'=>15, 'maxlength'=>15, 'id'=>'loginPassword')) ?></td>
					</tr>
					<tr>
						<th><?php echo checkbox_tag('keepLogin', true, true, array('id'=>'loginKeepLogin')) ?></th>
						<td colspan="2"><label for="loginKeepLogin">Manter conectado</label></td>
					</tr>
					<tr>
						<th></th>
						<td><?php echo button_tag('submitLogin', 'Logar', array('onclick'=>'doQuickLogin()')) ?></td>
						<td style="width: 100px"><?php echo image_tag('ajaxLoaderForm.gif', array('style'=>'display: none', 'id'=>'indicatorLogin')) ?></td>
					</tr>
					<tr>
						<td colspan="3" style="text-align: center; padding-top: 5px">
							<?php echo link_to('Novo cadastro', '/sign') ?>
							<?php echo link_to('Esqueci a senha', '/login/retrievePassword', array('style'=>'margin-left: 15px')) ?>
						</td>
					</tr>
				</table>