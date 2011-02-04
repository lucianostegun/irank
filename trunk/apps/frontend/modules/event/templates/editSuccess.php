<?php
	$isNew             = $eventObj->isNew();
	$pastDate          = ($isNew?false:$eventObj->isPastDate() && !$isClone);
	$confirmedPresence = ($isNew?false:$eventObj->isConfirmed($peopleId));
	$inviteStatus      = ($isNew?'none':$eventObj->getInviteStatus($peopleId));
	$visibleButtons    = $eventObj->getEnabled();

	if( !$pastDate && $inviteStatus!='deleted' )	
		include_partial('event/include/presenceBar', array('inviteStatus'=>$inviteStatus, 'visibleButtons'=>$visibleButtons));

	$pageAction = ($isClone?__('Cloning'):($eventObj->isNew()?__('Creating'):__('Editing')));
	
	if( !$eventObj->getEnabled() || $isClone ):
?>
<script>setRecordSaved(false);</script>
<?php
	endif;
?>
<div class="commonBar"><span><?php echo __('event.title') ?>/<?php echo $pageAction ?></span></div>
<?php
	$eventId  = $eventObj->getId();
	
	echo form_remote_tag(array(
		'url'=>'event/save'.($pastDate?'Result':''),
		'success'=>'handleSuccessEvent'.($pastDate?'Result':'').'( request.responseText )',
		'failure'=>'enableButton("mainSubmit"); handleFormFieldError( request.responseText, "eventForm", "event", false, "event" )',
		'encoding'=>'utf8',
		'loading'=>'showIndicator()'
		), array( 'id'=>'eventForm' ));
	
	echo input_hidden_tag('eventId', $eventId);
	
	$isEditable = $eventObj->isEditable();
	$isMyEvent  = $eventObj->isMyEvent();
	$mode       = ($pastDate && !$isClone?'show':'form');
	$resultMode = ($isEditable?'form':'show');
	
	$dhtmlxTabBarObj = new DhtmlxTabBar('main');
	$dhtmlxTabBarObj->addTab('main', __('Event'), 'event/'.$mode.'/main', array('eventObj'=>$eventObj, 'pastDate'=>$pastDate, 'confirmedPresence'=>$confirmedPresence));
	$dhtmlxTabBarObj->addTab('player', __('Guests'), 'event/'.$mode.'/player', array('eventObj'=>$eventObj, 'hidden'=>$isNew));
	if( $pastDate )
		$dhtmlxTabBarObj->addTab('result', __('Result'), 'event/'.$resultMode.'/result', array('eventObj'=>$eventObj));
	$dhtmlxTabBarObj->addTab('comments', __('Comments'), 'event/form/comments', array('eventObj'=>$eventObj, 'hidden'=>!$eventObj->getVisible()));
	$dhtmlxTabBarObj->addHandler('onSelect', 'onSelectTabEvent');
	$dhtmlxTabBarObj->setHeight(250);
	$dhtmlxTabBarObj->build();
	
	if( $isEditable || $isMyEvent ):
?>
	<div class="buttonTabBar" id="eventMainButtonBar">
		<?php
			if( $isEditable )				
				echo button_tag('mainSubmit', __('button.save'), array('onclick'=>'doSubmitEvent()'));
			
			if( $isMyEvent && !$isNew )
				echo button_tag('cloneEvent', __('button.cloneEvent'), array('onclick'=>'cloneEvent('.$eventId.')', 'image'=>'../icon/clone'));
				
			if( $isEditable && !$isNew )				
				echo button_tag('deleteEvent', __('button.deleteEvent'), array('onclick'=>'doDeleteEvent()', 'image'=>'../icon/delete', 'style'=>'float: right'));
		
			echo getFormLoading('event');
			echo getFormStatus();
		?>
	</div>
<?php endif; ?>
</form>
<?php
	DhtmlxWindows::createWindow('eventPhotoView', '', 380, 125, 'event/dialog/photoView', array());
	DhtmlxWindows::createWindow('rankingPlaceAdd', __('event.gamePlaceRegister'), 550, 125, 'ranking/dialog/placeAdd', array());
?>