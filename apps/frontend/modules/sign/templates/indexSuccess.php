<script>
function handleSuccessSign(content){
	alert(content);
}

function doSubmitSign(){
	
	showIndicator('sign');
	disableButton('mainSubmit');
	$('signForm').onsubmit();
}
</script>
<?php
	echo form_remote_tag(array(
		'url'=>'sign/save',
		'success'=>'handleSuccessSign( request.responseText )',
		'failure'=>'enableButton("mainSubmit"); handleFormFieldError( request.responseText, "signForm", "sign", false, "sign" )',
		'encoding'=>'utf8',
		'loading'=>'showIndicator()'
		), array( 'id'=>'signForm' ));
?>
	<div class="leftPanel"></div>
	<div class="rightPanel">
<table width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td valign="top" width="715" id="formTableSign">
			<div class="defaultForm" id="signFormDiv">
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
					<div class="label" id="signFirstNameLabel">Nome</div>
					<div class="field"><?php echo input_tag('firstName', null, array('size'=>20, 'maxlength'=>25, 'class'=>'required', 'id'=>'signFirstName')) ?></div>
					<div class="error" id="signFirstNameError" onclick="showFormErrorDetails('sign', 'firstName')"></div>
				</div>
				<div class="row">
					<div class="label" id="signLastNameLabel">Sobrenome</div>
					<div class="field"><?php echo input_tag('lastName', null, array('size'=>20, 'maxlength'=>25, 'id'=>'signLastName')) ?></div>
					<div class="error" id="signLastNameError" onclick="showFormErrorDetails('sign', 'lastName')"></div>
				</div>
				<div class="row">
					<div class="label" id="signPasswordLabel">Senha</div>
					<div class="field"><?php echo input_password_tag('password', null, array('size'=>15, 'maxlength'=>15, 'class'=>'required', 'id'=>'signPassword')) ?></div>
					<div class="error" id="signPasswordError" onclick="showFormErrorDetails('sign', 'password')"></div>
				</div>
				<div class="row">
					<div class="label" id="signPasswordConfirmLabel">Confirmação</div>
					<div class="field"><?php echo input_password_tag('passwordConfirm', null, array('size'=>15, 'maxlength'=>15, 'class'=>'required', 'id'=>'signPasswordConfirm')) ?></div>
					<div class="error" id="signPasswordConfirmError" onclick="showFormErrorDetails('sign', 'passwordConfirm')"></div>
				</div>
			</div>
		</td>
		<td valign="top"><div class="defaultFormErrorDetails" id="formErrorDetailsSign"><h1>Detalhes do erro</h1></div></td>
	</tr>
</table>
<div class="buttonBarForm">
	<?php echo button_tag('mainSubmit', 'Enviar', array('onclick'=>'doSubmitSign()')) ?>
	<?php echo getFormLoading('sign') ?>
</div>
	</div>
</form>