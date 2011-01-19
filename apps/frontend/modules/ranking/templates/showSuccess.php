<div class="commonBar"><span>Rankings/Visualização</span></div>
<?php
	$dhtmlxTabBarObj = new DhtmlxTabBar('main');
	$dhtmlxTabBarObj->addTab('event', 'Eventos', 'ranking/form/event', array('rankingObj'=>$rankingObj));
	$dhtmlxTabBarObj->addTab('classify', 'Classificação', 'ranking/form/classify', array('rankingObj'=>$rankingObj));
	$dhtmlxTabBarObj->setHeight(250);
	$dhtmlxTabBarObj->build();
?>