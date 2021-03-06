<?php include_partial('home/component/commonBar', array('pathList'=>array('Cadastro'=>null))); ?>
<div class="moduleIntro">
	<?php echo __('sign.intro') ?>
</div>
<div align="center">
	<table cellspacing="0" cellpadding="0" class="formTable" style="width: 600px">
		<tr>
			<th><h1><?php echo __('sign.signUpForm') ?></h1></th>
		</tr>
		<tr>
			<td valign="top">
				<?php
					echo form_remote_tag(array(
						'url'=>'sign/save',
						'success'=>'handleSuccessSign(request.responseText, true)',
						'failure'=>'handleFailureSign(request.responseText)',
						'encoding'=>'UTF8',
						), array( 'id'=>'signForm' ));
				?>
				<div class="defaultForm">
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
	
					<div class="separator"></div>
					<div class="buttonBarForm" id="signMainButtonBar">
						<?php echo button_tag('mainSubmit', __('sign.form.send'), array('onclick'=>'doSubmitSign()')) ?>
						<?php echo getFormLoading('sign') ?>
						<?php echo getFormStatus(null, false, 'Erro ao salvar o cadastro!', 'Cadastro salvo com sucesso!'); ?>
					</div>
				</div>
			</td>
		</tr>
	</table>
</div>
</form>