<div class="commonBar"><span>Configurações</span></div>
<?php
	
	echo form_remote_tag(array(
		'url'=>'sign/saveOptions',
		'success'=>'handleSuccessUserOptions( request.responseText )',
		'failure'=>'enableButton("mainSubmit"); handleFormFieldError( request.responseText, "userOptionsForm", "userOptions", false, "userOptions" )',
		'encoding'=>'utf8',
		'loading'=>'showIndicator()'
		), array( 'id'=>'userOptionsForm' ));
	
	$dhtmlxTabBarObj = new DhtmlxTabBar('main');
	$dhtmlxTabBarObj->addTab('email', 'E-mail', 'sign/options/email', array('userSiteObj'=>$userSiteObj));
	$dhtmlxTabBarObj->setHeight(250);
	$dhtmlxTabBarObj->build();
?>
	<div class="buttonBarForm" id="eventMainButtonBar">
		<?php echo button_tag('mainSubmit', 'Salvar', array('onclick'=>'doSubmitUserOptions()')); ?>
		<?php echo getFormLoading('userOptions') ?>
		<?php echo getFormStatus(); ?>
	</div>
</form>