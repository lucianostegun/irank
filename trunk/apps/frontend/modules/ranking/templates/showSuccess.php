<div class="commonBar"><span>Rankings/<?php echo __('ranking.Viewing') ?></span></div>
<?php
	$dhtmlxTabBarObj = new DhtmlxTabBar('main');
	$dhtmlxTabBarObj->addTab('main', 'Ranking', 'ranking/show/main', array('rankingObj'=>$rankingObj));
	$dhtmlxTabBarObj->addTab('event', __('ranking.events'), 'ranking/form/event', array('rankingObj'=>$rankingObj));
	$dhtmlxTabBarObj->addTab('classify', __('ranking.classify'), 'ranking/form/classify', array('rankingObj'=>$rankingObj));
	$dhtmlxTabBarObj->setHeight(250);
	$dhtmlxTabBarObj->build();
?>