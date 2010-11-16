<?php
	echo form_remote_tag(array(
		'url'=>'sign/save',
		'success'=>'handleSuccessSign( request.responseText )',
		'failure'=>'enableButton("mainSubmit"); handleFormFieldError( request.responseText, "signForm", "sign", false, "sign" )',
		'encoding'=>'utf8',
		'loading'=>'showIndicator()'
		), array( 'id'=>'signForm' ));
	
	echo input_hidden_tag('username', $userSiteObj->getUsername(), array('id'=>'signUsername'));
	echo input_hidden_tag('password', $userSiteObj->getPassword(), array('id'=>'signPassword'));
	echo input_hidden_tag('passwordConfirm', $userSiteObj->getPassword(), array('id'=>'signPasswordConfirm'));
?>
	<table width="100%" cellspacing="1" cellpadding="0" class="defaultForm">
		<tr>
			<td valign="top">
				<div class="row">
					<div class="label" id="signUsernameLabel">Username</div>
					<div class="text"><?php echo $userSiteObj->getUsername() ?></div>
				</div>
				<div class="row">
					<div class="label" id="signEmailAddressLabel">E-mail</div>
					<div class="field"><?php echo input_tag('emailAddress', $userSiteObj->getPeople()->getEmailAddress(), array('size'=>25, 'maxlength'=>150, 'class'=>'required', 'id'=>'signEmailAddress')) ?></div>
					<div class="error" id="signEmailAddressError" onclick="showFormErrorDetails('sign', 'emailAddress')"></div>
				</div>
				<div class="row">
					<div class="label" id="signFirstNameLabel">Nome</div>
					<div class="field"><?php echo input_tag('firstName', $userSiteObj->getPeople()->getFirstName(), array('size'=>20, 'maxlength'=>25, 'class'=>'required', 'id'=>'signFirstName')) ?></div>
					<div class="error" id="signFirstNameError" onclick="showFormErrorDetails('sign', 'firstName')"></div>
				</div>
				<div class="row">
					<div class="label" id="signLastNameLabel">Sobrenome</div>
					<div class="field"><?php echo input_tag('lastName', $userSiteObj->getPeople()->getLastName(), array('size'=>20, 'maxlength'=>25, 'id'=>'signLastName')) ?></div>
					<div class="error" id="signLastNameError" onclick="showFormErrorDetails('sign', 'lastName')"></div>
				</div>
				<div class="row" id="passwordChangeRowDiv">
					<div class="label">Senha</div>
					<div class="text"><?php echo link_to('Trocar senha de acesso', '#togglePasswordField()') ?></div>
				</div>
				<div id="passwordAreaDiv"></div>
			</td>
		</tr>
	</table>
	<div class="buttonBarForm">
		<?php echo button_tag('mainSubmit', 'Gravar alterações', array('onclick'=>'doSubmitSign()')) ?>
		<?php echo getFormLoading('sign') ?>
		<?php echo getFormStatus() ?>
	</div>
</form>