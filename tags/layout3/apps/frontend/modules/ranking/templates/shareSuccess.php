<?php
	$rankingName = $rankingObj->getName();
	$pathList    = array('Rankings'=>'ranking/index', $rankingName=>null);
	$userSiteId  = $sf_user->getAttribute('userSiteId');
	
	include_partial('home/component/commonBar', array('pathList'=>$pathList));
	
	$hasPendingRequest = $rankingObj->hasPendingSubscriptionRequest($userSiteId);
	
	if( !$rankingObj->isPlayer() ):
?>
<div class="subscribeBar">
	<span><b>Quer participar dos eventos desse ranking?</b> Cadastre-se e envie seu pedido de inscrição aos organizadores.</span>
	<?php echo button_tag('subscribeRequest', ($hasPendingRequest?'Pedido já enviado':'Enviar pedido'), array('onclick'=>'sendSubscribeRequest('.$rankingObj->getId().', '.($hasPendingRequest?'true':'false').')', 'image'=>($hasPendingRequest?'ok.png':'arrowRight.png'), 'style'=>'top: -3px; left: 5px', 'class'=>'right')) ?>
</div>
<?php
	endif;
	
	echo input_hidden_tag('rankingId', $rankingObj->getId());
	
	$dhtmlxTabBarObj = new DhtmlxTabBar('main');
	$dhtmlxTabBarObj->addTab('main', 'Ranking', 'ranking/share/main', array('rankingObj'=>$rankingObj));
	$dhtmlxTabBarObj->addTab('player', __('ranking.players'), 'ranking/share/player', array('rankingObj'=>$rankingObj));
	$dhtmlxTabBarObj->addTab('event', __('ranking.events'), 'ranking/share/event', array('rankingObj'=>$rankingObj));
	$dhtmlxTabBarObj->addTab('classify', __('ranking.classify'), 'ranking/share/classify', array('rankingObj'=>$rankingObj));
	$dhtmlxTabBarObj->setHeight(250);
	$dhtmlxTabBarObj->build();
	
	unset($rankingObj);
	unset($dhtmlxTabBarObj);
?>