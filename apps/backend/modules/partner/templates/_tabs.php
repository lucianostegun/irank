<?php
	echo form_remote_tag(array(
		'url'=>'partner/save',
		'success'=>'handleSuccessPartner( request.responseText )',
		'failure'=>'enableToolbar("save"); handleFormFieldError( request.responseText, "mainForm", "partner" )',
		'encoding'=>'utf8',
		'loading'=>'showIndicator()'
		), array( 'id'=>'mainForm' ));
		
	$partnerId = $partnerObj->getId();
	echo input_hidden_tag( 'partnerId', $partnerId );

	$dhtmlxTabBarObj = new DhtmlxTabBar('main');
	$dhtmlxTabBarObj->addTab('main', 'Principal', 'partner/form/main', array('partnerObj'=>$partnerObj, 'readOnly'=>$readOnly));
	
	$dhtmlxTabBarObj->build();
?>
</form>