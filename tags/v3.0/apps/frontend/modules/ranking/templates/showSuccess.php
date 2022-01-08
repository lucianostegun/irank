<?php
	$rankingName = $rankingObj->getName();
	$pathList    = array('Rankings'=>'ranking/index', $rankingName=>null);
	
	include_partial('home/component/commonBar', array('pathList'=>$pathList));
?>
<?php
	echo input_hidden_tag('rankingId', $rankingObj->getId());
	
	$dhtmlxTabBarObj = new DhtmlxTabBar('main');
	$dhtmlxTabBarObj->addTab('main', 'Ranking', 'ranking/show/main', array('rankingObj'=>$rankingObj));
	$dhtmlxTabBarObj->addTab('event', __('ranking.events'), 'ranking/form/event', array('rankingObj'=>$rankingObj));
	$dhtmlxTabBarObj->addTab('classify', __('ranking.classify'), 'ranking/form/classify', array('rankingObj'=>$rankingObj));
	$dhtmlxTabBarObj->setHeight(250);
	$dhtmlxTabBarObj->build();
?>