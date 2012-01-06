<div class="loginContent">
	<div id="loginToolbar" align="center">
		<div style="width: 1000px" align="right">
			<table style="margin: 6 50" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td><?php echo link_to('Esqueci a senha', '#getPasswordRecoveryForm()') ?></td>
				</tr>
			</table>
		</div>
	</div>
	<?php
	echo form_remote_tag(array(
		'url'=>'login/login',
		'success'=>'handleLoginSuccess( request.responseText )',
		'failure'=>'handleLoginFailure( request.responseText )',
		'encoding'=>'UTF8',
		'loading'=>'cleanLoginErrors(); showIndicator()'
		), array( 'id'=>'mainForm' ));
	
	echo input_hidden_tag('triedUrl', $triedUrl);
	?> 
	<div id="loginBar" align="right">
		<div style="float: left; width: 200px; position: absolute; top: 0px; left: 0px;" align="left">
			<?php echo image_tag('backend/login/logo', array('id'=>'logo')) ?>
		</div>
		<div style="width: 1000px" align="right">
			<table style="margin: 9px 50px 0px 0px" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td>
						<div id="statusMessageDiv">Mensagem de erro</div>
						<div id="indicator">Processando, aguarde...</div>
					</td>
					<td class="label">Usuário</td>
					<td class="field"><?php echo input_tag('username', null, array('size'=>'20')) ?></td>
					<td class="label">Senha</td>
					<td class="field"><?php echo input_password_tag('password', null, array('size'=>'15')) ?></td>
					<td style="padding-left: 8px">
						<?php
							echo button_tag('login', 'Login', array('onclick'=>'doLogin()', 'noCkeck'=>true));
						?>
					</td>
				</tr>
			</table>
		</div>
	</div>
	</form>
	<center>
		<table style="width: 1000px; margin-top: 20px" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td valign="top"></td>
				<td>
					<div style="float: right; width: 450px; font-size: 10pt" id="retrievePasswordDiv"></div>
				</td>
			</tr>
		</table>
	</center>
	</div>
</div>

<script>
function setFocus(){
	
	$('username').focus();
}

setFocus();
</script>