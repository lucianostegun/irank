<?php
	sfContext::getInstance()->getResponse()->addStylesheet('leftMenu');
	
	$firstName  = MyTools::getAttribute('firstName');
	$lastName   = MyTools::getAttribute('lastName');
	
	$moduleName = MyTools::getContext()->getModuleName();
?>
<div class="userInfo">Olá <b><?php echo $firstName ?></b></div>
<div id="leftMenu">
	<div onclick="goToPage('ranking', 'index')" class="item<?php echo ($moduleName=='ranking'?' active':'') ?>" onmouseover="this.addClassName('hover')" onmouseout="this.removeClassName('hover')"><div class="label">Meus rankings</div></div>
	<div onclick="goToPage('event', 'index')" class="item<?php echo ($moduleName=='event'?' active':'') ?>" onmouseover="this.addClassName('hover')" onmouseout="this.removeClassName('hover')"><div class="label">Eventos</div></div>
	<div onclick="goToPage('eventPersonal', 'index')" class="item<?php echo ($moduleName=='eventPersonal'?' active':'') ?>" onmouseover="this.addClassName('hover')" onmouseout="this.removeClassName('hover')"><div class="label">Eventos pessoais</div></div>
	<div class="separator"></div>
	<div onclick="goToPage('statistic', 'index')" class="item<?php echo ($moduleName=='statistic'?' active':'') ?>" onmouseover="this.addClassName('hover')" onmouseout="this.removeClassName('hover')"><div class="label icon stats">Estatísticas</div></div>
	<div onclick="goToPage('myAccount', 'index')" class="item<?php echo ($moduleName=='myAccount'?' active':'') ?>" onmouseover="this.addClassName('hover')" onmouseout="this.removeClassName('hover')"><div class="label icon config">Configurações</div></div>
</div>