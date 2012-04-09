<?php
	$status       = 'maybe';//$eventLiveObj->getInviteStatus();
	$toggleStatus = ($status=='yes'?'no':'yes');
	$toggleLabel  = ($status=='yes'?'presença confirmada':'confirmar presença');
	
	$buyin       = Util::formatFloat($eventLiveObj->getBuyin(), true);
	$entranceFee = $eventLiveObj->getEntranceFee();
	
	$rankingName = $eventLiveObj->getRankingLive()->toString();
	
	if( $entranceFee > 0 )
		$buyin = sprintf('%s+%s', Util::formatFloat($entranceFee, true), $buyin);
		
	$eventId = $eventLiveObj->getId();
?>
<div class="eventLive next" onmouseover="this.addClassName('hover')" onmouseout="this.removeClassName('hover')" style="background-image: url('/images/ranking/thumb/<?php echo $eventLiveObj->getRankingLive()->getFileNameLogo() ?>')">
	<div class="when" onclick="loadEventLive(<?php echo $eventId ?>)"><?php echo Util::getWeekDay($eventLiveObj->getEventDateTime('d/m/Y')).', '.$eventLiveObj->getEventDateTime('d/m/Y H:i') ?></div>
	<div class="where" onclick="loadEventLive(<?php echo $eventId ?>)"><b>@ <?php echo $eventLiveObj->getClub()->toString() ?></b> - <?php echo $eventLiveObj->getClub()->getLocation() ?></div>
	<div class="title" onclick="loadEventLive(<?php echo $eventId ?>)"><?php echo $eventLiveObj->getEventName() ?></div>
	<div class="ranking" onclick="loadEventLive(<?php echo $eventId ?>)"><?php echo ($rankingName?'['.$rankingName.']':'') ?></div>
	<div class="howMuch" onclick="loadEventLive(<?php echo $eventId ?>)"><b>Buyin:</b> <?php echo $buyin ?></div>
	<div class="presence <?php echo $status ?>" id="presenceToggler<?php echo $eventId ?>" onmouseover="this.className=this.className.replace('presence', 'presence hover')" onmouseout="this.className=this.className.replace(' hover', '')">
		<?php echo link_to($toggleLabel, '#toggleMyPresence('.$eventId.', \''.$toggleStatus.'\'); return false', array('class'=>$status)); ?>
	</div>
	<div class="clear"></div>
</div>