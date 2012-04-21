<?php
	echo form_remote_tag(array(
		'url'=>'userTools/save',
		'success'=>'handleSuccessUserTools(response)',
		'failure'=>'handleFailureUserTools(response.responseText)',
		),
		array('class'=>'form', 'id'=>'userToolsForm'));
//	echo form_tag('userTools/save', array('class'=>'form', 'id'=>'userToolsForm'));
	
	echo input_hidden_tag('password', $userAdminObj->getPassword(), array('id'=>'userAdminPassword'));

	$password = $userAdminObj->getPassword();
?>
	<div class="formRow">
		<label>Clube</label>
		<div class="formRight"><?php echo $userAdminObj->getClub()->toString('Sem club definido') ?></div>
		<div class="clear"></div>
	</div>
	
	<?php
		$peopleId = $userAdminObj->getPeopleId();
		echo input_hidden_tag('peopleId', $peopleId, array('id'=>'userToolsPeopleId'));
	?>
	
	<div class="formRow">
		<label>Pessoa</label>
		<div class="formRight">
			<?php echo input_tag('peopleName', $userAdminObj->getPeople()->getName(), array('size'=>35, 'maxlength'=>200, 'id'=>'userToolsPeopleName')) ?>
			<div class="formNote error" id="userToolsFormErrorPeopleName"></div>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Username</label>
		<div class="formRight">
			<?php echo input_tag('username', $userAdminObj->getUsername(), array('maxlength'=>15, 'id'=>'userToolsUsername')) ?>
			<div class="formNote error" id="userToolsFormErrorUsername"></div>
		</div>
		<div class="clear"></div>
	</div>
	
	<div style="display: <?php echo ($password?'none':'block') ?>" id="passwordFieldDiv">
		<div class="formRow">
			<label>Senha</label>
			<div class="formRight">
				<?php echo input_password_tag('newPassword', ($password?'******':''), array('maxlength'=>15, 'id'=>'userToolsNewPassword')) ?>
				<div class="formNote error" id="userToolsFormErrorPassword"></div>
			</div>
			<div class="clear"></div>
		</div>

		<div class="formRow">
			<label>Confirmação</label>
			<div class="formRight">
				<?php echo input_password_tag('passwordConfirm', ($password?'******':''), array('maxlength'=>15, 'id'=>'userToolsPasswordConfirm')) ?>
				<div class="formNote error" id="userToolsFormErrorPasswordConfirm"></div>
			</div>
			<div class="clear"></div>
		</div>
	</div>
	
	<div class="formRow" style="display: <?php echo ($password?'block':'none') ?>" id="passwordRoDiv">
		<label>Senha</label>
		<div class="formRight"><label><?php echo link_to('alterar senha', '#togglePasswordField()') ?></label></div>
		<div class="clear"></div>
	</div>
</div>
</form>