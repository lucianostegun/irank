<?php
	$isNew      = $eventPersonalObj->isNew();
	$isEditable = $eventPersonalObj->isEditable();
	$pastDate   = $eventPersonalObj->isPastDate();
	$isMyEvent  = $eventPersonalObj->isMyEvent();
?>
<div class="innerMenu" style="display: <?php echo ($isNew && $actionName!='index'?'none':'block') ?>" id="mainMenuEvent">
	<?php if( $isNew && $actionName=='index' ): ?>
	<?php else: ?>
	<div onclick="cloneEventPersonal()" class="subitem" onmouseover="this.addClassName('hover')" onmouseout="this.removeClassName('hover')"><div class="label icon clone"><?php echo __('button.cloneEvent') ?></div></div>

   	<div onclick="doDeleteEventPersonal()" class="subitem" onmouseover="this.addClassName('hover')" onmouseout="this.removeClassName('hover')"><div class="label icon delete"><?php echo __('button.deleteEvent') ?></div></div>
	<?php endif; ?>
</div>