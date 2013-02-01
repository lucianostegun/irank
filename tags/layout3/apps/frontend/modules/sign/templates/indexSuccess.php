<?php include_partial('home/component/commonBar', array('pathList'=>array('Cadastro'=>null))); ?>
<?php echo image_tag('sign', array('class'=>'logo')) ?>
<div class="moduleIntro image">
	Crie seu cadastro e tenha acesso agora mesmo a criação de rankings, eventos,<br/>
	controle de bankroll, geração de estatísticas e muito mais.<br/><br/>
	É simples, rápido e gratuito. 
</div>
<hr class="separator"/>
<div align="center">
	<?php
		echo form_remote_tag(array(
			'url'=>'sign/save',
			'success'=>'handleSuccessSign(request.responseText, true)',
			'failure'=>'handleFailureSign(request.responseText)',
			'encoding'=>'UTF8',
			), array( 'id'=>'signForm' ));
	?>
	<div class="defaultForm">
		<div>
			<div class="row">
				<div class="label" id="signUsernameLabel">Username</div>
				<div class="field"><?php echo input_tag('username', null, array('size'=>15, 'maxlength'=>15, 'class'=>'required', 'id'=>'signUsername')) ?></div>
				<div class="error" id="signUsernameError" onclick="showFormErrorDetails('sign', 'username')"></div>
			</div>
			<div class="row">
				<div class="label" id="signEmailAddressLabel">E-mail</div>
				<div class="field"><?php echo input_tag('emailAddress', null, array('size'=>25, 'maxlength'=>150, 'class'=>'required', 'id'=>'signEmailAddress')) ?></div>
				<div class="error" id="signEmailAddressError" onclick="showFormErrorDetails('sign', 'emailAddress')"></div>
			</div>
			<div class="row">
				<div class="label" id="signFirstNameLabel"><?php echo __('sign.form.firstName') ?></div>
				<div class="field"><?php echo input_tag('firstName', null, array('size'=>20, 'maxlength'=>25, 'class'=>'required', 'id'=>'signFirstName')) ?></div>
				<div class="error" id="signFirstNameError" onclick="showFormErrorDetails('sign', 'firstName')"></div>
			</div>
			<div class="row">
				<div class="label" id="signLastNameLabel"><?php echo __('sign.form.lastName') ?></div>
				<div class="field"><?php echo input_tag('lastName', null, array('size'=>20, 'maxlength'=>25, 'id'=>'signLastName')) ?></div>
				<div class="error" id="signLastNameError" onclick="showFormErrorDetails('sign', 'lastName')"></div>
			</div>
			<div class="row">
				<div class="label" id="signPasswordLabel"><?php echo __('sign.form.password') ?></div>
				<div class="field"><?php echo input_password_tag('password', null, array('size'=>15, 'maxlength'=>15, 'class'=>'required', 'id'=>'signPassword')) ?></div>
				<div class="error" id="signPasswordError" onclick="showFormErrorDetails('sign', 'password')"></div>
			</div>
			<div class="row">
				<div class="label" id="signPasswordConfirmLabel"><?php echo __('sign.form.passwordConfirm') ?></div>
				<div class="field"><?php echo input_password_tag('passwordConfirm', null, array('size'=>15, 'maxlength'=>15, 'class'=>'required', 'id'=>'signPasswordConfirm')) ?></div>
				<div class="error" id="signPasswordConfirmError" onclick="showFormErrorDetails('sign', 'passwordConfirm')"></div>
			</div>
			
			<div class="row">
				<div class="field textR" style="width: 168px"><?php echo checkbox_tag('agreeUserTerms', true, false, array('id'=>'signAgreeUserTerms')) ?></div>
				<div class="textCheckbox"><label for="signAgreeUserTerms">Li e concordo com os <?php echo link_to('termos de uso do site', 'sign/userTerms', array('target'=>'_blank')) ?></label></div>
				<div class="clear errorHelp" style="margin-left: -95px" id="signAgreeUserTermsError">É preciso ler e aceitar os termos de uso para concluir o cadastro</div>
			</div>
		</div>

		<hr/>
		
		<div class="buttonBarForm" id="signMainButtonBar">
			<?php echo button_tag('mainSubmit', __('sign.form.send'), array('onclick'=>'doSubmitSign()')) ?>
			<?php echo getFormLoading('sign') ?>
			<?php echo getFormStatus(null, false, 'Erro ao salvar as informações!', 'Cadastro salvo com sucesso!'); ?>
		</div>
	</div>
</div>
</form>