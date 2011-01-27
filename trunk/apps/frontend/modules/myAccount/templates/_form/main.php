<table width="100%" cellspacing="0" cellpadding="0" class="defaultForm">
	<tr>
		<td valign="top">
			<div class="row">
				<div class="label" id="myAccountUsernameLabel">Username</div>
				<div class="text"><?php echo $userSiteObj->getUsername() ?></div>
			</div>
			<div class="row">
				<div class="label" id="myAccountEmailAddressLabel">E-mail</div>
				<div class="field"><?php echo input_tag('emailAddress', $userSiteObj->getPeople()->getEmailAddress(), array('size'=>25, 'maxlength'=>150, 'class'=>'required', 'id'=>'myAccountEmailAddress')) ?></div>
				<div class="error" id="myAccountEmailAddressError" onclick="showFormErrorDetails('myAccount', 'emailAddress')"></div>
			</div>
			<div class="row">
				<div class="label" id="myAccountFirstNameLabel"><?php echo __('sign.form.firstName') ?></div>
				<div class="field"><?php echo input_tag('firstName', $userSiteObj->getPeople()->getFirstName(), array('size'=>20, 'maxlength'=>25, 'class'=>'required', 'id'=>'myAccountFirstName')) ?></div>
				<div class="error" id="myAccountFirstNameError" onclick="showFormErrorDetails('myAccount', 'firstName')"></div>
			</div>
			<div class="row">
				<div class="label" id="myAccountLastNameLabel"><?php echo __('sign.form.lastName') ?></div>
				<div class="field"><?php echo input_tag('lastName', $userSiteObj->getPeople()->getLastName(), array('size'=>20, 'maxlength'=>25, 'id'=>'myAccountLastName')) ?></div>
				<div class="error" id="myAccountLastNameError" onclick="showFormErrorDetails('myAccount', 'lastName')"></div>
			</div>
			<div class="row" id="passwordChangeRowDiv">
				<div class="label"><?php echo __('sign.form.password') ?></div>
				<div class="text"><?php echo link_to(__('sign.form.changePassword'), '#togglePasswordField()') ?></div>
			</div>
			<div id="passwordAreaDiv"></div>
		</td>
	</tr>
</table>