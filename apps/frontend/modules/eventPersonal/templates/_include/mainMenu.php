<?php
	$eventObj   = $innerObj;
	$isNew      = $eventObj->isNew();
	$isEditable = $eventObj->isEditable();
	$pastDate   = $eventObj->isPastDate();
	$isMyEvent  = $eventObj->isMyEvent();
?>
<div class="innerMenu" style="display: <?php echo ($isNew?'none':'block') ?>" id="mainMenuEvent">
<?php if( $isMyEvent || $isNew ): ?>
   	<div class="innerItem" style="background: url('/images/icon/add.png') 10px 5px no-repeat"><?php echo link_to(__('leftBar.newEvent'), 'eventPersonal/new', array('title'=>__('event.newEvent'))) ?></div>
	<div class="innerItem" style="background: url('/images/icon/clone.png') 10px 5px no-repeat"><?php echo link_to(__('button.cloneEvent'), '#cloneEventPersonal()') ?></div>
	
	<br/><br/>
	<div class="innerItem" style="background: url('/images/icon/delete.png') 10px 5px no-repeat"><?php echo link_to(__('button.deleteEvent'), '#doDeleteEventPersonal()') ?></div>
<?php endif; ?>
</div>