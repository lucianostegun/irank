<?php
	sfContext::getInstance()->getResponse()->addStylesheet('leftMenu');
	
	$firstName  = MyTools::getAttribute('firstName');
	$lastName   = MyTools::getAttribute('lastName');
	
	$moduleName = MyTools::getContext()->getModuleName();
	$actionName = MyTools::getContext()->getActionName();
	
	$invites   = People::getPendingInviteList(false, 'home');
	$invites  += People::getPendingInviteList(false, 'live');
	$purchases = UserSite::getPendingPurchases();
?>
<div class="userInfo">Olá <b><?php echo $firstName ?></b></div>
<div id="leftMenu">

	<div class="item<?php echo ($moduleName=='myAccount' && $actionName=='invites'?' active':'') ?>"><div class="label flex" onclick="goToPage('myAccount', 'invites')">Meus convites</div><span class="numberTop" id="pendingInvitesCount"><?php echo $invites ?></span></div>
	
	<div class="separator"></div>
	
	<div class="item<?php echo ($moduleName=='ranking'?' active':'') ?>"><div class="label flex" onclick="goToPage('ranking', 'index', false, false, false, event)">Meus rankings</div><div class="iconRight<?php echo ($moduleName=='ranking'?' active':'') ?>" onclick="goToPage('ranking', 'new', false, false, false, event)" title="Criar novo ranking"><?php echo image_tag('layout/leftMenu/add') ?></div></div>
	<?php if($moduleName=='ranking' && $actionName!='index') include_partial('ranking/include/leftMenu', array('rankingObj'=>$innerObj, 'actionName'=>$actionName)) ?>
	<?php if($moduleName=='ranking' && $actionName=='index') include_partial('ranking/include/leftFilter', array()) ?>
	
	<div class="item<?php echo ($moduleName=='event'?' active':'') ?>"><div class="label flex" onclick="goToPage('event', 'index', false, false, false, event)">Meus eventos</div><div class="iconRight<?php echo ($moduleName=='event'?' active':'') ?>" onclick="goToPage('event', 'new', false, false, false, event)" title="Criar novo evento padrão"><?php echo image_tag('layout/leftMenu/add') ?></div></div>
	<?php if($moduleName=='event' && $actionName!='index') include_partial('event/include/leftMenu', array('eventObj'=>$innerObj, 'actionName'=>$actionName)) ?>
	<?php if($moduleName=='event' && $actionName=='index') include_partial('event/include/leftFilter', array()) ?>
	
	<div class="item<?php echo ($moduleName=='eventPersonal'?' active':'') ?>"><div class="label flex" onclick="goToPage('eventPersonal', 'index', false, false, false, event)">Eventos pessoais</div><div class="iconRight<?php echo ($moduleName=='eventPersonal'?' active':'') ?>" onclick="goToPage('eventPersonal', 'new', false, false, false, event)" title="Criar novo evento pessoal"><?php echo image_tag('layout/leftMenu/add') ?></div></div>
	<?php if($moduleName=='eventPersonal' && $actionName!='index') include_partial('eventPersonal/include/leftMenu', array('eventPersonalObj'=>$innerObj, 'actionName'=>$actionName)) ?>
	
	<div class="separator"></div>
	<div class="item<?php echo ($moduleName=='store'?' active':'') ?>"><div class="label icon store" onclick="goToPage('store', 'myOrders')">Minhas compras</div><span class="numberTop" id="pendingInvitesCount"><?php echo $purchases ?></span></div>
	<div class="item<?php echo ($moduleName=='statistic'?' active':'') ?>"><div class="label icon stats" onclick="goToPage('statistic', 'index')">Estatísticas</div></div>
	<div class="item<?php echo ($moduleName=='myAccount' && $actionName=='index'?' active':'') ?>"><div class="label icon config" onclick="goToPage('myAccount', 'index')">Minha conta</div></div>
	<div class="separator"></div>
	<div class="item"><div class="label icon logout" onclick="goToPage('login', 'logout')">Desconectar</div></div>
</div>