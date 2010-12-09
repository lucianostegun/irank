<?php

	$pastDate          = $eventObj->isPastDate();
	$inviteStatus      = $eventObj->getInviteStatus($peopleId);
	$visibleButtons    = $eventObj->getEnabled();
	
	if( !$pastDate )	
		include_partial('event/include/presenceBar', array('inviteStatus'=>$inviteStatus, 'visibleButtons'=>$visibleButtons));
		
	echo getPageHeader('Visualização de evento');

	$eventId = $eventObj->getId();
	echo input_hidden_tag('eventId', $eventId);
	
	$confirmedPresence = $eventObj->isConfirmed($peopleId);
	
	$dhtmlxTabBarObj = new DhtmlxTabBar('main');
	$dhtmlxTabBarObj->addTab('main', 'Evento', 'event/show/main', array('eventObj'=>$eventObj));
	$dhtmlxTabBarObj->addTab('player', 'Convidados', 'event/show/player', array('eventObj'=>$eventObj));
	if( $pastDate )
		$dhtmlxTabBarObj->addTab('result', 'Resultado', 'event/show/result', array('eventObj'=>$eventObj));
	$dhtmlxTabBarObj->setHeight(250);
	$dhtmlxTabBarObj->build();
?>
</form>