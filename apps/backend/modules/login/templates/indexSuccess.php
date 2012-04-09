<?php
	echo form_remote_tag(array(
		'url'=>'login/login',
		'success'=>'handleSuccessLogin(request.responseText)',
		'failure'=>'handleFailureLogin(request.responseText)',
		'encoding'=>'UTF8',
		), array('id'=>'loginForm'));
?>
		<div id="login-wrapper" class="png_bg">
			<div id="login-top">
			
				<!-- Logo (221px width) -->
				<?php echo image_tag('backend/login/logo', array('id'=>'logo')) ?>

			</div> <!-- End #logn-top -->
			
			<div id="login-content">
				
				<form action="index.html">
				
					<div class="notification error png_bg" id="loginErrorMessageDiv">
						<div>
							<b>ACESSO NEGADO!</b></br>Usuário/Senha inválidos.
						</div>
					</div>
					
					<p>

						<label>Usuário</label>
						<input class="text-input" type="text" name="username" />
					</p>
					<div class="clear"></div>
					<p>
						<label>Senha</label>
						<input class="text-input" type="password" name="password" />
					</p>

					<div class="clear"></div>
					<div class="clear"></div>
						<input class="button" type="submit" value="ENTRAR" />
					
				</form>

			</div> <!-- End #login-content -->
			
		</div> <!-- End #login-wrapper -->
</form>