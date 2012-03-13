<?php
	$isNew      = $eventObj->isNew();
	$isEditable = $eventObj->isEditable();
	$pastDate   = $eventObj->isPastDate();
	$isMyEvent  = $eventObj->isMyEvent();
?>
<div class="innerMenu">
	<?php if( $isNew && $actionName=='index' ): ?>
	<div onclick="goToPage('event', 'new')" class="subitem" onmouseover="this.addClassName('hover')" onmouseout="this.removeClassName('hover')"><div class="label icon add">Novo evento</div></div>
	<div class="separator"></div>
	<?php endif; ?>
	<div style="display: <?php echo ($isNew?'none':'block') ?>" id="mainMenuEvent">
	   	<div onclick="getICalFile()" class="subitem" onmouseover="this.addClassName('hover')" onmouseout="this.removeClassName('hover')"><div class="label icon ical"><?php echo __('button.iCalFile') ?></div></div>
		<div class="separator"></div>
		
	<?php if( $isMyEvent || $isNew ): ?>
		<div onclick="cloneEvent()" class="subitem" onmouseover="this.addClassName('hover')" onmouseout="this.removeClassName('hover')"><div class="label icon clone"><?php echo __('button.cloneEvent') ?></div></div>
		
		<?php if( $isEditable ): ?>
	   	
	   	<div onclick="addRankingPlayer()" class="subitem" onmouseover="this.addClassName('hover')" onmouseout="this.removeClassName('hover')"><div class="label icon player"><?php echo __('button.newPlayer') ?></div></div>
	   	<div onclick="importPlayers()" class="subitem" onmouseover="this.addClassName('hover')" onmouseout="this.removeClassName('hover')"><div class="label icon players"><?php echo __('button.importPlayers') ?></div></div>
	   	
		<div class="separator"></div>
	
	   	<div onclick="doDeleteEvent()" class="subitem" onmouseover="this.addClassName('hover')" onmouseout="this.removeClassName('hover')"><div class="label icon delete"><?php echo __('button.deleteEvent') ?></div></div>
		<?php endif; ?>
	<?php endif; ?>
	</div>
</div>