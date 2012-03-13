<?php
	$isNew      = $eventPersonalObj->isNew();
	$isEditable = $eventPersonalObj->isEditable();
	$pastDate   = $eventPersonalObj->isPastDate();
	$isMyEvent  = $eventPersonalObj->isMyEvent();
?>
<div class="innerMenu">
	<?php if( $isNew && $actionName=='index' ): ?>
	<div onclick="goToPage('eventPersonal', 'new')" class="subitem" onmouseover="this.addClassName('hover')" onmouseout="this.removeClassName('hover')"><div class="label icon add">Novo evento</div></div>
	<div class="separator"></div>
	<?php endif; ?>
	<div style="display: <?php echo ($isNew?'none':'block') ?>" id="mainMenuEvent">
	<?php if( $isMyEvent || $isNew ): ?>
	<div onclick="cloneEventPersonal()" class="subitem" onmouseover="this.addClassName('hover')" onmouseout="this.removeClassName('hover')"><div class="label icon clone"><?php echo __('button.cloneEvent') ?></div></div>

   	<div onclick="doDeleteEventPersonal()" class="subitem" onmouseover="this.addClassName('hover')" onmouseout="this.removeClassName('hover')"><div class="label icon delete"><?php echo __('button.deleteEvent') ?></div></div>
	<?php endif; ?>
	</div>
</div>