<div class="commonBar"><span>Eventos/Visualização</span></div>
<?php

	$pastDate          = $eventObj->isPastDate();
	$inviteStatus      = $eventObj->getInviteStatus($peopleId);
	$visibleButtons    = $eventObj->getEnabled();
	
	if( !$pastDate )	
		include_partial('event/include/presenceBar', array('inviteStatus'=>$inviteStatus, 'visibleButtons'=>$visibleButtons));
		
	$eventId = $eventObj->getId();
	echo input_hidden_tag('eventId', $eventId);
	
	$confirmedPresence = $eventObj->isConfirmed($peopleId);
	
	$dhtmlxTabBarObj = new DhtmlxTabBar('main');
	$dhtmlxTabBarObj->addTab('main', __('Event'), 'event/show/main', array('eventObj'=>$eventObj));
	$dhtmlxTabBarObj->addTab('player', __('Guests'), 'event/show/player', array('eventObj'=>$eventObj));
	if( $pastDate )
		$dhtmlxTabBarObj->addTab('result', __('Result'), 'event/show/result', array('eventObj'=>$eventObj));
	$dhtmlxTabBarObj->addTab('comments', __('Comments'), 'event/form/comments', array('eventObj'=>$eventObj));
	$dhtmlxTabBarObj->addHandler('onSelect', 'onSelectTabEvent');
	$dhtmlxTabBarObj->setHeight(250);
	$dhtmlxTabBarObj->build();
?>
</form>
<?php
	DhtmlxWindows::createWindow('eventPhotoView', '', 380, 125, 'event/dialog/photoView', array());
?>