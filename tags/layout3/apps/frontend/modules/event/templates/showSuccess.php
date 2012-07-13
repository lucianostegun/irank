<?php

	$pathList = array('Eventos'=>'event/index');
	
	$eventName   = $eventObj->getName();
	$rankingName = $eventObj->getRanking()->getName();
	$rankingId   = $eventObj->getRankingId();
	
	$pathList[$rankingName] = '#goToPage("ranking", "edit", "rankingId", '.$rankingId.', true)';
	$pathList[$eventName]   = '';
		
	include_partial('home/component/commonBar', array('pathList'=>$pathList));

	$pastDate          = $eventObj->isPastDate();
	$inviteStatus      = $eventObj->getInviteStatus($peopleId);
	$visibleButtons    = $eventObj->getEnabled();
	
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