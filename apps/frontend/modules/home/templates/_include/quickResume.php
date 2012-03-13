<?php
	sfContext::getInstance()->getResponse()->addStylesheet('quickResume');
	
	$resumeInfo = People::getFullResume();
?>
<div id="quickResume">
	<h1>Bankroll</h1>
	<div style="margin-top: 17px"></div>
	<div class="row">
		<div class="label">Buy-ins</div>
		<div class="value"><?php echo Util::formatFloat($resumeInfo['buyin'], true) ?></div>
	</div>
	<div class="row">
		<div class="label">Rebuys</div>
		<div class="value"><?php echo Util::formatFloat($resumeInfo['rebuy'], true) ?></div>
	</div>
	<div class="row">
		<div class="label">Add-ons</div>
		<div class="value"><?php echo Util::formatFloat($resumeInfo['addon'], true) ?></div>
	</div>
	<div class="row">
		<div class="label">Ganhos</div>
		<div class="value"><?php echo Util::formatFloat($resumeInfo['prize'], true) ?></div>
	</div>
	<div class="row">
		<div class="label">SALDO</div>
		<div class="value"><?php echo Util::formatFloat($resumeInfo['balance'], true) ?></div>
	</div>
	<div class="separator"></div>
	<div class="row">
		<div class="label">Eventos</div>
		<div class="value"><?php echo $resumeInfo['events'] ?></div>
	</div>
	<div class="row">
		<div class="label">Rankings</div>
		<div class="value"><?php echo $resumeInfo['rankings'] ?></div>
	</div>
	<div class="row">
		<div class="label">Comentários</div>
		<div class="value"><?php echo $resumeInfo['comments'] ?></div>
	</div>
	<div class="row">
		<div class="label">Fotos</div>
		<div class="value"><?php echo $resumeInfo['photos'] ?></div>
	</div>
</div>
<div class="logout"><?php echo link_to('desconectar', '/login/logout') ?></div>