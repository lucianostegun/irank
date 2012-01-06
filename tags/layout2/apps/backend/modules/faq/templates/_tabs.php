<?php
	echo form_remote_tag(array(
		'url'=>'faq/save',
		'success'=>'handleSuccessFaq( request.responseText )',
		'failure'=>'enableToolbar("save"); handleFormFieldError( request.responseText, "mainForm", "faq" )',
		'encoding'=>'utf8',
		'loading'=>'showIndicator()'
		), array( 'id'=>'mainForm' ));
		
	$faqId = $faqObj->getId();
	echo input_hidden_tag( 'faqId', $faqId );
	echo input_hidden_tag( 'gridboxI18nData', null );

	$dhtmlxTabBarObj = new DhtmlxTabBar('main');
	$dhtmlxTabBarObj->addTab('main', 'Principal', 'faq/form/main', array('faqObj'=>$faqObj, 'readOnly'=>$readOnly));
	
	$dhtmlxTabBarObj->build();
?>
</form>