<?php
	$status       = $eventLiveObj->getInviteStatus();
	$toggleStatus = ($status=='yes'?'no':'yes');
	$toggleLabel  = ($status=='yes'?'presença confirmada':'confirmar presença');
	
	$buyin       = Util::formatFloat($eventLiveObj->getBuyin(), true);
	$entranceFee = $eventLiveObj->getEntranceFee();
	
	$rankingName = $eventLiveObj->getRankingLive()->toString();
	
	if( $entranceFee > 0 )
		$buyin = sprintf('%s+%s', Util::formatFloat($entranceFee, true), $buyin);
		
	$eventId = $eventLiveObj->getId();
?>
<div class="eventLive next" onmouseover="this.addClassName('hover')" onmouseout="this.removeClassName('hover')" onclick="loadEventLive(<?php echo $eventId ?>)">
	<div class="title"><?php echo $eventLiveObj->getEventName() ?></div>
	<div class="image"><?php echo image_tag('ranking/'.$eventLiveObj->getRankingLive()->getFileNameLogo()) ?></div>
	<div class="eventInfo">
		<div class="when"><?php echo Util::getWeekDay($eventLiveObj->getEventDateTime('d/m/Y')).', '.$eventLiveObj->getEventDateTime('d/m/Y H:i') ?></div>
		<div class="where"><b>@ <?php echo $eventLiveObj->getClub()->toString() ?></b></div>
		<div class="howMuch">
			<label>Buyin:</label><span><?php echo $eventLiveObj->getBuyinInfo() ?></span>
			<label>Blinds:</label><span><?php echo $eventLiveObj->getBlindTime('H:i') ?></span>
			<label>Stack:</label><span><?php echo $eventLiveObj->getStackChips(true) ?></span>
		</div>
		<?php echo ($rankingName?'<div class="ranking"><label>#</label><span>'.truncate_text($rankingName, 15).'</span></div>':'') ?>
	</div>
	<div class="clear"></div>
</div>