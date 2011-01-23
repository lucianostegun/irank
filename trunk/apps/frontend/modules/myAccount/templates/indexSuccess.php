<div class="commonBar"><span>Edição de perfil</span></div>
<?php
	
	echo form_remote_tag(array(
		'url'=>'myAccount/save',
		'success'=>'handleSuccessMyAccount( request.responseText )',
		'failure'=>'enableButton("mainSubmit"); handleFormFieldError( request.responseText, "myAccountForm", "myAccount", false, "myAccount" )',
		'encoding'=>'utf8',
		'loading'=>'showIndicator()'
		), array( 'id'=>'myAccountForm' ));
	
	$dhtmlxTabBarObj = new DhtmlxTabBar('main');
	$dhtmlxTabBarObj->setSelectedTabBarId($selectedTab);
	$dhtmlxTabBarObj->addTab('main', 'Principal', 'myAccount/options/main', array('userSiteObj'=>$userSiteObj));
	$dhtmlxTabBarObj->addTab('options', 'E-mail', 'myAccount/options/email', array('userSiteObj'=>$userSiteObj));
	$dhtmlxTabBarObj->setHeight(250);
	$dhtmlxTabBarObj->build();
?>
	<div class="buttonTabBar" id="eventMainButtonBar">
		<?php echo button_tag('mainSubmit', 'Salvar', array('onclick'=>'doSubmitMyAccount()')); ?>
		<?php echo getFormLoading('myAccount') ?>
		<?php echo getFormStatus(); ?>
	</div>
</form>