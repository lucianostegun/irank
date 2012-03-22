<script>
function doLogin(){
	
	$('loginForm').submit();
}

</script>
<table style="width: 100%">
	<tr>
		<td style="text-align: center">
			<?php echo form_tag('login/login', array('id'=>'loginForm')) ?>
			<div id="login">
				<?php echo image_tag('backend/login/logo') ?>
				<br/><br/>
				<table class="loginTable">
					<tr>
						<th>Usuário/E-mail</th>
						<td><?php echo input_tag('username', null, array('autocomplete'=>'on')) ?></td>
					</tr>
					<tr>
						<th>Senha</th>
						<td><?php echo input_password_tag('password', null, array('autocomplete'=>'on')) ?></td>
					</tr>
					<tr>
						<td></td>
						<td><?php echo button_tag('login', 'ENTRAR', array('onclick'=>'doLogin()')) ?></td>
					</tr>
				</table>
			</div>
			</form>		
		</td>
	</tr>
</table>