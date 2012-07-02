<?php 
	$moduleName = MyTools::getContext()->getModuleName();
	
	echo link_to('home', '/home', array('class'=>($moduleName=='home'?'first active':'first')));
	echo link_to(__('topMenu.myiRank'), '/myAccount', array('class'=>($moduleName=='myAccount'?'active':'')));
	echo link_to('Onde jogar', '/club', array('class'=>($moduleName=='club'?'active':'')));
	echo link_to('Agenda', '/eventLive', array('class'=>(in_array($moduleName, array('eventLive', 'schedule'))?'active':'')));
	echo link_to('Ranking', '/rankingLive', array('class'=>($moduleName=='rankingLive')?'active':''));
	echo link_to(__('topMenu.contact'), '/contact', array('class'=>($moduleName=='contact'?'active':'')));
	echo link_to('Loja virtual', '/store', array('class'=>'store last'.($moduleName=='contact'?' active':'')));
?>