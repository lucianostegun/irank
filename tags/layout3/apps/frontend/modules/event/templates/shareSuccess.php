<?php
	$pathList = array('Eventos'=>'event/index');
	
	$eventName   = $eventObj->getName();
	$rankingName = $eventObj->getRanking()->getName();
	$rankingId   = $eventObj->getRankingId();
	$userSiteId  = $sf_user->getAttribute('userSiteId');
	
	$pathList[$rankingName] = '#goToPage("ranking", "share", "rankingId", '.$rankingId.', true)';
	$pathList[$eventName]   = null;
		
	include_partial('home/component/commonBar', array('pathList'=>$pathList));
	
	$rankingObj        = $eventObj->getRanking();
	$hasPendingRequest = $rankingObj->hasPendingSubscriptionRequest($userSiteId);
	
	if( !$rankingObj->isPlayer() ):
?>
<div class="subscribeBar">
	<span><b>Quer participar dos eventos desse ranking?</b> Cadastre-se e envie seu pedido de inscrição aos organizadores.</span>
	<?php echo button_tag('subscribeRequest', ($hasPendingRequest?'Pedido já enviado':'Enviar pedido'), array('onclick'=>'sendSubscribeRequest('.$eventObj->getRankingId().', '.($hasPendingRequest?'true':'false').')', 'image'=>($hasPendingRequest?'ok.png':'arrowRight.png'), 'style'=>'top: -3px; left: 5px', 'class'=>'right')) ?>
</div>
<?php
	endif;
	
	$pastDate          = $eventObj->isPastDate();
	$inviteStatus      = $eventObj->getInviteStatus($peopleId);
	$visibleButtons    = $eventObj->getEnabled();
	
	$readOnly = (!$sf_user->isAuthenticated() || !$eventObj->isMyEvent());
	
	$eventId = $eventObj->getId();
	echo input_hidden_tag('eventId', $eventId);
	
	$dhtmlxTabBarObj = new DhtmlxTabBar('main');
	$dhtmlxTabBarObj->addTab('main', __('Event'), 'event/share/main', array('eventObj'=>$eventObj, 'readOnly'=>$readOnly));
	$dhtmlxTabBarObj->addTab('player', __('Guests'), 'event/share/player', array('eventObj'=>$eventObj, 'readOnly'=>$readOnly));
	
	if( $pastDate && $eventObj->getSavedResult() )
		$dhtmlxTabBarObj->addTab('result', __('Result'), 'event/share/result', array('eventObj'=>$eventObj, 'readOnly'=>$readOnly));
		
	$dhtmlxTabBarObj->addTab('comments', __('Comments'), 'event/share/comments', array('eventObj'=>$eventObj, 'readOnly'=>$readOnly));
	$dhtmlxTabBarObj->addHandler('onSelect', 'onSelectTabEvent');
	$dhtmlxTabBarObj->setHeight(250);
	$dhtmlxTabBarObj->build();
	
	unset($rankingObj);
	unset($eventObj);
	unset($dhtmlxTabBarObj);
?>