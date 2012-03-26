<?php 
	$moduleName = MyTools::getContext()->getModuleName();
	
	echo link_to('home', '/home', array('class'=>($moduleName=='home'?'first active':'first')));
	echo link_to(__('topMenu.myiRank'), '/myAccount', array('class'=>($moduleName=='myAccount'?'active':'')));
	echo link_to('Onde jogar', '/club', array('class'=>($moduleName=='club'?'active':'')));
	echo link_to('Eventos', '/eventLive', array('class'=>($moduleName=='eventLive'?'active':'')));
	echo link_to(__('topMenu.contact'), '/contact', array('class'=>($moduleName=='contact'?'last active':'last')));
?>