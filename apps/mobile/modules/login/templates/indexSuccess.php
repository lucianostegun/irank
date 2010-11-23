<?php
	echo form_remote_tag(array(
		'url'=>'login/login',
		'success'=>'handleLoginSuccess( request.responseText )',
		'failure'=>'handleLoginFailure( request.responseText )',
		'encoding'=>'UTF8',
		'loading'=>'showIndicator()'
		), array( 'id'=>'mainForm' ));
?> 
<div align="center" class="login">
	<table border="0" cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td valign="bottom" height="60">
				<div id="formStatusDiv">
					<div id="statusMessage"></div>
				</div>
			</td>
		</tr>
		<tr>
			<td align="center">
				<table border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td valign="top" style="padding-top: 15px">
							<div align="center" style="background: #FFFFFF">
								<table border="0" cellpadding="0" cellspacing="0" width="240">
									<tr>
										<td width="10" height="10">
										<img border="0" src="/images/mobile/login/borderTopLeft.png" width="10" height="10"></td>
										<td height="10" background="/images/mobile/login/borderTop.png"></td>
										<td width="10" height="10">
										<img border="0" src="/images/mobile/login/borderTopRight.png" width="10" height="10"></td>
									</tr>
									<tr>
										<td width="10" background="/images/mobile/login/borderLeft.png">&nbsp;</td>
										<td>

										<table border="0" cellpadding="0" cellspacing="0" width="100%">
											<tr>
												<td class="label">Usuário</td>
												<td width="128"><?php echo input_tag( 'username', null, array( 'size'=>20 ) ) ?></td>
											</tr>
											<tr>
												<td class="label">Senha</td>
												<td width="128"><?php echo input_tag( 'password', null, array( 'size'=>20, 'type'=>'password' ) ) ?></td>
											</tr>
											<tr>
												<td colspan="2" class="button">
													<?php echo button_tag('mainSubmit', 'Logar', array('style'=>'float: right', 'onclick'=>'doLogin()')) ?>
												</td>
											</tr>
										</table>
										</td>
										<td width="10" background="/images/mobile/login/borderRight.png"></td>
									</tr>
									<tr>
										<td width="10" height="10"><img border="0" src="/images/mobile/login/borderBaseLeft.png" width="10" height="10"></td>
										<td height="10" background="/images/mobile/login/borderBase.png"></td>
										<td width="10" height="10"><img border="0" src="/images/mobile/login/borderBaseRight.png" width="10" height="10"></td>
									</tr>
								</table>
							</div>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td></td>
		</tr>
	</table>
</div>
</form>
<script>
function setFocus(){
	
	$('username').focus();
}

setFocus();
</script>