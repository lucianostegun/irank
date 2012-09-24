<?php 
	$moduleName = MyTools::getContext()->getModuleName();
	
	echo link_to('home', '/home', array('class'=>($moduleName=='home'?'first active':'first')));
	echo link_to('Blog', '/blog', array('class'=>($moduleName=='blog'?'active':'')));
	echo link_to('Minha conta', '/myAccount', array('class'=>($moduleName=='myAccount'?'active':'')));
	echo link_to('Onde jogar', '/club', array('class'=>($moduleName=='club'?'active':'')));
	echo link_to(__('topMenu.contact'), '/contact', array('class'=>($moduleName=='contact'?'active':'')));
	echo link_to('Loja virtual', '/store', array('class'=>'store last'.($moduleName=='store'?' active':'')));
?>