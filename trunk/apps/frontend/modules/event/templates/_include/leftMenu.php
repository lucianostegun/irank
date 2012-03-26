<?php
	$isNew      = $eventObj->isNew();
	$isEditable = $eventObj->isEditable();
	$pastDate   = $eventObj->isPastDate();
	$isMyEvent  = $eventObj->isMyEvent();
	
	$hidden = ($isNew && $actionName!='index' || $actionName=='confirmPresence');
?>
<div class="innerMenu" style="display: <?php echo ($hidden?'none':'block') ?>" id="mainMenuEvent">
	<?php if( $isNew && $actionName=='index' ): ?>

	<?php else: ?>
	   	<div onclick="getICalFile()" class="subitem" onmouseover="this.addClassName('hover')" onmouseout="this.removeClassName('hover')"><div class="label icon ical"><?php echo __('button.iCalFile') ?></div></div>
		<div class="separator"></div>
		
	<?php if( $isMyEvent ): ?>
		<div onclick="cloneEvent()" class="subitem" onmouseover="this.addClassName('hover')" onmouseout="this.removeClassName('hover')"><div class="label icon clone"><?php echo __('button.cloneEvent') ?></div></div>
		
		<?php if( $isEditable ): ?>
	   	
	   	<div onclick="addRankingPlayer()" class="subitem" onmouseover="this.addClassName('hover')" onmouseout="this.removeClassName('hover')"><div class="label icon player"><?php echo __('button.newPlayer') ?></div></div>
	   	<div onclick="importPlayers()" class="subitem" onmouseover="this.addClassName('hover')" onmouseout="this.removeClassName('hover')"><div class="label icon players"><?php echo __('button.importPlayers') ?></div></div>
	   	
		<div class="separator"></div>
	
	   	<div onclick="doDeleteEvent()" class="subitem" onmouseover="this.addClassName('hover')" onmouseout="this.removeClassName('hover')"><div class="label icon delete"><?php echo __('button.deleteEvent') ?></div></div>
		<?php endif; ?>
	<?php endif; ?>
	<?php endif; ?>
</div>