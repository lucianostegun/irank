<?php
	echo form_remote_tag(array(
		'url'=>'userAdmin/save',
		'success'=>'handleSuccessUserAdmin(response)',
		'failure'=>'handleFailureUserAdmin(response.responseText)',
		),
		array('class'=>'form', 'id'=>'userAdminForm'));
	
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
			<?php echo input_tag('peopleName', $userAdminObj->getPeople()->getName(), array('size'=>35, 'maxlength'=>200, 'id'=>'userAdminPeopleName')) ?>
			<div class="formNote error" id="userAdminFormErrorPeopleName"></div>
		</div>
		<div class="clear"></div>
	</div>


	<script>
		var urlAjax = _webRoot+'/people/autoComplete';
		
	    $("#userAdminPeopleName").autocomplete({
	        source: function(request, response) {
				
	            $.ajax({
	                url: urlAjax,
	                data: request,
	                dataType: "json",
	                success: function(data) {
	                    response(data);
	                },
	                error: function(data) {
	                	
	                },
	            });
	        },
            select: function(event, ui) { $('#userAdminPeopleId').val(ui.item.id) },
	    });
	</script>

	<div class="formRow">
		<label>Username</label>
		<div class="formRight">
			<?php echo input_tag('username', $userAdminObj->getUsername(), array('maxlength'=>15, 'id'=>'userAdminUsername')) ?>
			<div class="formNote error" id="userAdminFormErrorUsername"></div>
		</div>
		<div class="clear"></div>
	</div>
	
	<div style="display: <?php echo ($password?'none':'block') ?>" id="passwordFieldDiv">
		<div class="formRow">
			<label>Senha</label>
			<div class="formRight">
				<?php echo input_password_tag('newPassword', ($password?'******':''), array('maxlength'=>15, 'id'=>'userAdminNewPassword')) ?>
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
		<div class="formRight"><?php echo checkbox_tag('master', true, $userAdminObj->getMaster(), array('id'=>'userAdminMaster')) ?></div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Ativo</label>
		<div class="formRight"><?php echo checkbox_tag('active', true, $userAdminObj->getActive(), array('id'=>'userAdminActive')) ?></div>
		<div class="clear"></div>
	</div>
</div>
</form>