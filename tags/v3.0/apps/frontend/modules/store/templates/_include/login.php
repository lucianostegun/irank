<div id="signLoginTable">
	<table cellpadding="5" cellspacing="0">
		<thead>
			<tr>
				<th width="50%" class="border">Usuário existente</th>
				<th width="50%">Novo usuário</th>
			</tr>
		</thead>
		<tr>
			<td class="border" valign="top">
				<?php
					echo form_remote_tag(array(
						'url'=>'login/login',
						'success'=>'handleSuccessLoginStore(request.responseText, true)',
						'failure'=>'handleFailureLoginStore(request.responseText)',
						'encoding'=>'UTF8',
						), array('id'=>'loginForm'));
				?>
				<table class="quickForm" cellspacing="0" cellpadding="3">
					<tr>
						<td colspan="2" class="pb10">
							Se você ja é usuário do site, informe abaixo seu usuário/e-mail e senha de acesso.
							<div id="storeLoginErrorMessage"><b>Acesso negado!</b> Usuário/Senha inválidos</div>
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
						<td><?php echo button_tag('loginSubmitButton', 'Entrar', array('onclick'=>'doLogin()')) ?></td>
						<th><?php echo link_to('Recuperar senha', 'login/index', array('target'=>'_blank')) ?></th>
					</tr>
				</table>
				</form>
			</td>
			<td valign="top">
				<table class="quickForm" cellspacing="0" cellpadding="3" style="width: 300px">
					<tr>
						<td colspan="2" class="pb10">Caso você ainda não seja cadastrado, clique no botão abaixo e preencha rapidamente o formulário de cadastro para prosseguir com sua compra.</td>
					</tr>
					<tr>
						<td colspan="2" class="textC"><?php echo link_to(image_tag('store/signUp'), '#loadSignForm()') ?></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	<div class="clear mt400"></div>
</div>