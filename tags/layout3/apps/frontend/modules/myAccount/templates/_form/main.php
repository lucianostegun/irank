<?php
	$userSiteId = $userSiteObj->getId();
	$peopleId   = $userSiteObj->getPeopleId();
	$username   = $userSiteObj->getUsername();
	$filePath   = $userSiteObj->getImagePath(true);
	$rankings   = $userSiteObj->getRankingCount();
	
	$defaultLanguage   = $userSiteObj->getPeople()->getDefaultLanguage();
	$quickResume       = $userSiteObj->getOptionValue('quickResume');
	$quickResumePeriod = $userSiteObj->getOptionValue('quickResumePeriod', 'always');
?>
<div class="defaultForm">
	<div class="row">
		<div class="label" id="myAccountUsernameLabel">Username</div>
		<div class="text"><?php echo $username ?></div>
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
	

	<hr style="margin-bottom:0px"/>
	<br/>


	<div class="row">
		<div class="label"><?php echo __('myAccount.defaultLanguage') ?></div>
		<div class="field"><?php echo select_tag('defaultLanguage', options_for_select(array('en_US'=>'English', 'pt_BR'=>'Português'), $defaultLanguage)) ?></div>
	</div>
	
	<div class="row">
		<div class="label">Bankroll inicial</label></div>
		<div class="field"><?php echo input_tag('startBankroll', Util::formatFloat($userSiteObj->getStartBankroll(), true), array('size'=>8, 'maxlength'=>8, 'class'=>'textR', 'id'=>'myAccountStartBankroll')) ?></div>
	</div>
	
	<div class="row">
		<div class="label"><?php echo __('myAccount.quickResume') ?></div>
		<div class="field">
		<?php
			$optionList = array('balance'=>__('generalCredit.balance'),
								'profit'=>__('generalCredit.profit'),
								'score'=>__('generalCredit.score'),
								'average'=>__('generalCredit.average'),
								'paid'=>__('generalCredit.paid'));
								
			echo select_tag('quickResume', options_for_select($optionList, $quickResume), array('id'=>'myAccountQuickResume'));
		?>
		</div>

		<div class="labelFlex" style="margin-left: 20px">Desde<!-- I18N --></div>
		<div class="field">
		<?php
			$optionList = array('always'=>'Sempre',
								'currentYear'=>'Ano corrente',
								'lastYear'=>'Últimos 12 meses',
								'currentMonth'=>'Mês corrente',
								'lastMonth'=>'Últimos 30 dias');
								
			echo select_tag('quickResumePeriod', options_for_select($optionList, $quickResumePeriod));
		?>
		</div>
	</div>
</div>
<!-- I18N -->
<?php
	DhtmlxWindows::createWindow('photoCutter', 'Recorte de imagem', 500, 300, 'myAccount/dialog/photoCutter');
?>