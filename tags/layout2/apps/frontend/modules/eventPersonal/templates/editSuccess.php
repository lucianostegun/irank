<?php
	$isNew             = $eventPersonalObj->isNew();
	$pastDate          = ($isNew?false:$eventPersonalObj->isPastDate() && !$isClone);
	$visibleButtons    = $eventPersonalObj->getEnabled();

	$pageAction = ($isClone?__('Cloning'):($eventPersonalObj->isNew()?__('Creating'):__('Editing')));
	
	if( !$eventPersonalObj->getEnabled() || $isClone ):
?>
<script>setRecordSaved(false);</script>
<?php
	endif;
?>
<div class="commonBar"><span><?php echo __('eventPersonal.title') ?>/<?php echo $pageAction ?></span></div>
<?php
	$eventPersonalId  = $eventPersonalObj->getId();
	
	echo form_remote_tag(array(
		'url'=>'eventPersonal/save',
		'success'=>'handleSuccessEventPersonal( request.responseText )',
		'failure'=>'enableButton("mainSubmit"); handleFormFieldError( request.responseText, "eventPersonalForm", "eventPersonal", false, "eventPersonal" )',
		'encoding'=>'utf8',
		'loading'=>'showIndicator()'
		), array( 'id'=>'eventPersonalForm' ));
	
	echo input_hidden_tag('eventPersonalId', $eventPersonalId);
	echo input_hidden_tag('isClone', $isClone);
	
	$isEditable = $eventPersonalObj->isEditable();
	$isMyEvent  = $eventPersonalObj->isMyEvent();
	$mode       = ($isMyEvent?'form':'show');
	
	$dhtmlxTabBarObj = new DhtmlxTabBar('main');
	$dhtmlxTabBarObj->addTab('main', __('Event'), 'eventPersonal/'.$mode.'/main', array('eventPersonalObj'=>$eventPersonalObj, 'isClone'=>$isClone, 'pastDate'=>$pastDate));
	$dhtmlxTabBarObj->setHeight(250);
	$dhtmlxTabBarObj->build();
	
	if( $isEditable ):
?>
	<div class="buttonTabBar" id="eventPersonalMainButtonBar">
		<?php
			echo button_tag('mainSubmit', __('button.save'), array('onclick'=>'doSubmitEventPersonal()'));
			
			echo getFormLoading('eventPersonal');
			echo getFormStatus();
		?>
	</div>
<?php endif; ?>
</form>