<div class="commonBar"><span><?php echo __('myAccount.title') ?></span></div>
<?php
	
	echo form_remote_tag(array(
		'url'=>'myAccount/save',
		'success'=>'handleSuccessMyAccount( request.responseText )',
		'failure'=>'enableButton("mainSubmit"); handleFormFieldError( request.responseText, "myAccountForm", "myAccount", false, "myAccount" )',
		'encoding'=>'utf8',
		'loading'=>'showIndicator()'
		), array( 'id'=>'myAccountForm' ));
		
	echo input_hidden_tag('password', $userSiteObj->getPassword(), array('id'=>'myAccountPassword'));
	echo input_hidden_tag('passwordConfirm', $userSiteObj->getPassword(), array('id'=>'myAccountPasswordConfirm'));
	
	$dhtmlxTabBarObj = new DhtmlxTabBar('main');
	$dhtmlxTabBarObj->setSelectedTabBarId($selectedTab);
	$dhtmlxTabBarObj->addTab('main', __('tab.main'), 'myAccount/form/main', array('userSiteObj'=>$userSiteObj));
//	$dhtmlxTabBarObj->addTab('profile', 'Perfil', 'myAccount/form/profile', array('userSiteObj'=>$userSiteObj));
	$dhtmlxTabBarObj->addTab('options', 'Opções', 'myAccount/form/email', array('userSiteObj'=>$userSiteObj));
	$dhtmlxTabBarObj->setHeight(250);
	$dhtmlxTabBarObj->build();
?>
	<div class="buttonTabBar" id="eventMainButtonBar">
		<?php echo button_tag('mainSubmit', __('button.save'), array('onclick'=>'doSubmitMyAccount()')); ?>
		<?php echo getFormLoading('myAccount') ?>
		<?php echo getFormStatus(null, false, __('myAccount.errorMessage'), __('myAccount.successMessage')); ?>
	</div>
</form>