<?php
	echo form_remote_tag(array(
		'url'=>'login/login',
		'success'=>'handleLoginSuccess( request.responseText )',
		'failure'=>'handleLoginFailure( request.responseText )',
		'encoding'=>'UTF8',
		'loading'=>'showIndicator()'
		), array( 'id'=>'mainForm' ));
?>


<div id="errorMessage" class="text" align="center" style="display: none; font-weight: bold; color: #AA0000">
Usuário/Senha inválidos!<br/>Verifique as informações e tente novamente.
</div>
<br/>

<div align="center">
	<table width="95%" cellpadding="0" cellspacing="0" border="0" class="mobileForm">
		<tr>
			<td width="0" class="topLeft"><?php echo image_tag('mobile/form/topLeft') ?></td>
			<td width="100%" class="topMiddle"></td>
			<td width="0" class="topRight"><?php echo image_tag('mobile/form/topRight') ?></td>
		</tr>
	</table>
	<table width="95%" cellpadding="0" cellspacing="0" border="0" class="mobileForm">
		<tr>
			<td colspan="3" class="formContent">
			
				<table cellpadding="0" cellspacing="0" width="100%" class="formTable">
					<tr>
						<th class="firstLine">Usuário</th>
						<td class="firstLine"><?php echo input_tag('username', null, array('size'=>20, 'id'=>'loginUsername')) ?></td>
					</tr>
					<tr>
						<th class="lastLine">Senha</th>
						<td class="lastLine"><?php echo input_tag('password', null, array('size'=>20, 'type'=>'password', 'id'=>'loginPassword')) ?></td>
					</tr>
				</table>
							
			</td>
		</tr>
	</table>
	<table width="95%" cellpadding="0" cellspacing="0" border="0" class="mobileForm">
		<tr>
			<td class="baseLeft" width="0" valign="bottom"><?php echo image_tag('mobile/form/baseLeft') ?></td>
			<td width="100%" class="baseMiddle"></td>
			<td class="baseRight" width="0" valign="bottom"><?php echo image_tag('mobile/form/baseRight') ?></td>
		</tr>
	</table>

<br/><br/>

<table width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td align="right" style="padding-right: 20px"><?php echo image_tag('mobile/button/conclude', array('onclick'=>'doLogin()')) ?></div>
	</tr>
</table>
</div>

</form>
<script>
function setFocus(){

	$('loginUsername').focus();
}

setFocus();
</script>