<?php
	$eventObj   = $innerObj;
	$isNew      = $eventObj->isNew();
	$isEditable = $eventObj->isEditable();
	$pastDate   = $eventObj->isPastDate();
	$isMyEvent  = $eventObj->isMyEvent();
?>
<div class="innerMenu" style="display: <?php echo ($isNew?'none':'block') ?>" id="mainMenuEvent">
   	<div class="innerItem" style="background: url('/images/icon/calendar.png') 10px 5px no-repeat"><?php echo link_to(__('button.iCalFile'), '#getICalFile()', array('title'=>__('button.iCalFileTitle'))) ?></div>
<?php if( $isMyEvent || $isNew ): ?>
	<div class="innerItem" style="background: url('/images/icon/clone.png') 10px 5px no-repeat"><?php echo link_to(__('button.cloneEvent'), '#cloneEvent()') ?></div>
	
	<?php if( $isEditable ): ?>
   	<div class="innerItem" style="background: url('/images/icon/add.png') 10px 5px no-repeat"><?php echo link_to(__('button.newPlayer'), '#addRankingPlayer()') ?></div>
	<div class="innerItem" style="background: url('/images/icon/import.png') 10px 5px no-repeat"><?php echo link_to(__('button.importPlayers'), '#importPlayers()') ?></div>
	<br/><br/>
	<div class="innerItem" style="background: url('/images/icon/delete.png') 10px 5px no-repeat"><?php echo link_to(__('button.deleteEvent'), '#doDeleteEvent()') ?></div>
	<?php endif; ?>
<?php endif; ?>
</div>