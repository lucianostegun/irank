<?php
	$eventObj   = $innerObj;
	$isNew      = $eventObj->isNew();
	$isEditable = $eventObj->isEditable();
	$pastDate   = $eventObj->isPastDate();
	$isMyEvent  = $eventObj->isMyEvent();
	
	if( $isMyEvent ):
?>
	<div class="innerMenu">
	<?php if( $isMyEvent && !$isNew ): ?>
	<div class="innerItem" style="background: url('/images/icon/clone.png') 10px 5px no-repeat"><?php echo link_to(__('button.cloneEvent'), '#cloneEvent()') ?></div>
	<div class="innerItem" style="background: url('/images/icon/add.png') 10px 5px no-repeat"><?php echo link_to(__('button.newPlayer'), '#addRankingPlayer()') ?></div>
	<?php endif; ?>
	
	<?php if( $isEditable && !$isNew ): ?>
	<div class="innerItem" style="background: url('/images/icon/import.png') 10px 5px no-repeat"><?php echo link_to(__('button.importPlayers'), '#importPlayers()') ?></div>
	<br/><br/>
	<div class="innerItem" style="background: url('/images/icon/delete.png') 10px 5px no-repeat"><?php echo link_to(__('button.deleteEvent'), '#doDeleteEvent()') ?></div>
	<?php endif; ?>
</div>
<?php endif; ?>