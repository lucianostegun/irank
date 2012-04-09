<?php
	$status       = $eventObj->getInviteStatus();
	$toggleStatus = ($status=='yes'?'no':'yes');
	$toggleLabel  = ($status=='yes'?'presença confirmada':'confirmar presença');
	
	$buyin       = Util::formatFloat($eventObj->getBuyin(), true);
	$entranceFee = $eventObj->getEntranceFee();
	
	if( $entranceFee > 0 )
		$buyin = sprintf('%s+%s', Util::formatFloat($entranceFee, true), $buyin);
		
	$eventId = $eventObj->getId();
?>
<div class="event next" onmouseover="this.addClassName('hover')" onmouseout="this.removeClassName('hover')">
	<div class="when" onclick="loadEvent(<?php echo $eventId ?>)"><?php echo Util::getWeekDay($eventObj->getEventDateTime('d/m/Y')).', '.$eventObj->getEventDateTime('d/m/Y H:i') ?></div>
	<div class="where" onclick="loadEvent(<?php echo $eventId ?>)">@ <?php echo $eventObj->getRankingPlace()->getPlaceName() ?></div>
	<div class="title" onclick="loadEvent(<?php echo $eventId ?>)"><?php echo $eventObj->getEventName() ?></div>
	<div class="ranking" onclick="loadEvent(<?php echo $eventId ?>)">[<?php echo $eventObj->getRanking()->getRankingName() ?>]</div>
	<div class="howMuch" onclick="loadEvent(<?php echo $eventId ?>)"><b>Buyin:</b> <?php echo $buyin ?></div>
	<div class="presence <?php echo $status ?>" id="presenceToggler<?php echo $eventId ?>" onmouseover="this.className=this.className.replace('presence', 'presence hover')" onmouseout="this.className=this.className.replace(' hover', '')">
		<?php echo link_to($toggleLabel, '#toggleMyPresence('.$eventId.', \''.$toggleStatus.'\'); return false', array('class'=>$status)); ?>
	</div>
	<div class="clear"></div>
</div>