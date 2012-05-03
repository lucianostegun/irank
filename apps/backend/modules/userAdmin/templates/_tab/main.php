<?php
	echo form_remote_tag(array(
		'url'=>'userAdmin/save',
		'success'=>'handleSuccessUserAdmin(response)',
		'failure'=>'handleFailureUserAdmin(response.responseText)',
		'loading'=>'showIndicator()',
		),
		array('class'=>'form', 'id'=>'userAdminForm'));

//	echo form_tag('userAdmin/save', array('class'=>'form', 'id'=>'userAdminForm'));
	
	echo input_hidden_tag('userAdminId', $userAdminObj->getId());
	echo input_hidden_tag('password', $userAdminObj->getPassword(), array('id'=>'userAdminPassword'));

	$password = $userAdminObj->getPassword();
?>
	<div class="formRow">
		<label>Clube</label>
		<div class="formRight">
			<?php echo select_tag('clubId', Club::getOptionsForSelect($userAdminObj->getClubId()), array('id'=>'userAdminClubId')) ?>
			<div class="clear"></div>
			<div class="formNote error" id="userAdminFormErrorClubId"></div>
		</div>
		<div class="clear"></div>
	</div>
	
	<?php
		$peopleId = $userAdminObj->getPeopleId();
		echo input_hidden_tag('peopleId', $peopleId, array('id'=>'userAdminPeopleId'));
	?>
	
	<div class="formRow">
		<label>Pessoa</label>
		<div class="formRight">
			<?php echo input_autocomplete_tag('peopleName', $userAdminObj->getPeople()->getName(), 'people/autoComplete', 'doSelectUserAdminPeople', array('size'=>35, 'maxlength'=>200, 'suggestNew'=>false, 'id'=>'userAdminPeopleName')) ?>
			<div class="formNote error" id="userAdminFormErrorPeopleId"></div>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>E-mail</label>
		<div class="formRight">
			<?php echo input_tag('emailAddress', $userAdminObj->getPeople()->getEmailAddress(), array('autocomplete'=>'off', 'size'=>50, 'maxlength'=>150, 'id'=>'userAdminEmailAddress')) ?>
			<div class="formNote error" id="userAdminFormErrorEmailAddress"></div>
		</div>
		<div class="clear"></div>
	</div>
	
	<div class="formRow">
		<label>Username</label>
		<div class="formRight">
			<?php echo input_tag('username', $userAdminObj->getUsername(), array('autocomplete'=>'off', 'maxlength'=>15, 'id'=>'userAdminUsername')) ?>
			<div class="formNote error" id="userAdminFormErrorUsername"></div>
		</div>
		<div class="clear"></div>
	</div>
	
	<div style="display: <?php echo ($password?'none':'block') ?>" id="passwordFieldDiv">
		<div class="formRow">
			<label>Senha</label>
			<div class="formRight">
				<?php echo input_password_tag('newPassword', ($password?'******':''), array('autocomplete'=>'off', 'maxlength'=>15, 'id'=>'userAdminNewPassword')) ?>
				<div class="formNote error" id="userAdminFormErrorNewPassword"></div>
			</div>
			<div class="clear"></div>
		</div>

		<div class="formRow">
			<label>Confirmação</label>
			<div class="formRight">
				<?php echo input_password_tag('passwordConfirm', ($password?'******':''), array('maxlength'=>15, 'id'=>'userAdminPasswordConfirm')) ?>
				<div class="formNote error" id="userAdminFormErrorPasswordConfirm"></div>
			</div>
			<div class="clear"></div>
		</div>
	</div>
	
	<div class="formRow" style="display: <?php echo ($password?'block':'none') ?>" id="passwordRoDiv">
		<label>Senha</label>
		<div class="formRight"><label><?php echo link_to('alterar senha do usuário', '#togglePasswordField()') ?></label></div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Master</label>
		<div class="formRight">
			<?php echo checkbox_tag('master', true, $userAdminObj->getMaster(), array('id'=>'userAdminMaster')) ?>
			<div class="clear"></div>
			<div class="formNote error" id="userAdminFormErrorMaster"></div>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Ativo</label>
		<div class="formRight"><?php echo checkbox_tag('active', true, $userAdminObj->getActive(), array('id'=>'userAdminActive')) ?></div>
		<div class="clear"></div>
	</div>
</div>
</form>