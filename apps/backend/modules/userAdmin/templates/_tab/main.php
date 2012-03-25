<?php
	$password = $userAdminObj->getPassword();
?>
<div class="module_content">
	<div class="defaultForm">

		<section>
			<label>Clube</label>
			<?php echo select_tag('clubId', Club::getOptionsForSelect($userAdminObj->getClubId()), array('id'=>'userAdminClubId')) ?>
		</section>
		
		<?php
			$peopleId = $userAdminObj->getPeopleId();
		?>
		<section>
			<label>Nome</label>
			<span id="userAdminPeopleIdFieldDiv" class="<?php echo ($peopleId?'hidden':'') ?>">
			<?php
				echo input_hidden_tag('peopleId', $peopleId, array('id'=>'userAdminPeopleId'));
				echo input_auto_complete_tag(
			      'peopleName',
			      $userAdminObj->getPeople()->getName(),
			      'people/autoComplete?instanceName=peopleId&suggestNew='.Util::AUTO_COMPLETE_SUGGEST_NEW_IF_EMPTY,
			      array('autocomplete' => 'off', 'onkeyup'=>'$("userAdminPeopleId").value=""', 'size'=>35, 'id'=>'userAdminPeopleName'),
			      array(
			        'use_style'             => true,
			        'after_update_element'  => 'function (inputField, selectedItem){ selectAutoCompleteItem(selectedItem.id, inputField.value, \'userAdmin\', \'peopleId\', \'userAdminUsername\', {searchFieldName:\'userAdminPeopleName\', quickModuleName:\'people\'}) }',
			      	'with'                  => ' value+\'?&peopleName=\'+$("userAdminPeopleName").value',
			      	'inTab'                 => false)
			    );
			?>
			</span>
			<div id="userAdminPeopleIdRoDiv" class="text <?php echo ($peopleId?'':'hidden') ?>"><div id="userAdminPeopleIdDiv"><?php echo $userAdminObj->getPeople()->getName() ?></div></div>
			<div id="userAdminPeopleIdAutoComplete" class="image <?php echo ($peopleId?'':'hidden') ?>"><a href="javascript:void(0)" onclick="openAutoComplete('userAdmin', 'peopleId', 'userAdminPeopleName')"><?php echo image_tag('backend/icon/reload') ?></a></div>
		</section>

		<section>
			<label>Username</label>
			<?php echo input_tag('username', $userAdminObj->getUsername(), array('maxlength'=>15, 'id'=>'userAdminUsername')) ?>
		</section>
		
		<div style="display: <?php echo ($password?'none':'block') ?>" id="passwordFieldDiv">
			<section>
				<label>Senha</label>
				<?php echo input_password_tag('newPassword', ($password?'******':''), array('maxlength'=>15, 'id'=>'userAdminNewPassword')) ?>
			</section>
	
			<section>
				<label>Confirmação</label>
				<?php echo input_password_tag('passwordConfirm', ($password?'******':''), array('maxlength'=>15, 'id'=>'userAdminPasswordConfirm')) ?>
			</section>
		</div>
		<div style="display: <?php echo ($password?'block':'none') ?>" id="passwordRoDiv">
			<div class="text"><?php echo link_to('alterar senha do usuário', '#togglePasswordField()') ?></div>
		</div>

		<section>
			<label>Master</label>
			<?php echo checkbox_tag('master', true, $userAdminObj->getMaster(), array('id'=>'userAdminMaster')) ?>
		</section>

		<section>
			<label>Ativo</label>
			<?php echo checkbox_tag('active', true, $userAdminObj->getActive(), array('id'=>'userAdminActive')) ?>
		</section>
		
	</div>
	
</div>