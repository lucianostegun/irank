<table border="0" cellspacing="1" cellpadding="2" class="resumeEventTable">
	<tr>
		<th colspan="2"><?php echo __('resume.lastEvents') ?></th>
		<th class="icon"><?php echo image_tag('icon/positionGray', array('title'=>__('resume.position'))) ?></th>
		<th class="icon"><?php echo image_tag('icon/scoreGray', array('title'=>__('resume.score'))) ?></th>
		<th class="icon"><?php echo image_tag('icon/buyinGray', array('title'=>'Buyin')) ?></th>
		<th class="icon"><?php echo image_tag('icon/rebuyGray', array('title'=>'Rebuy')) ?></th>
		<th class="icon"><?php echo image_tag('icon/addonGray', array('title'=>'Addon')) ?></th>
		<th class="icon"><?php echo image_tag('icon/prizeGray', array('title'=>__('resume.prizes'))) ?></th>
	</tr>
<?php	
	foreach($eventObjList as $eventObj):
		
		$eventPlayerObj = EventPlayerPeer::retrieveByPK($eventObj->getId(), $peopleId);
		
		$savedResult = $eventObj->getSavedResult();
		
		$eventDescription = $eventObj->getEventDate('d/m/Y').' '.$eventObj->getStartTime('H:i').' - <b>'.$eventObj->getEventName().'</b> @ '.$eventObj->getEventPlace().' ['.$eventObj->getRanking()->getRankingName().']';
		$eventDescription = truncate_text($eventDescription, 120);
?>
	<tr>
		<td align="center" style="padding: 0px"><?php echo (!$savedResult?image_tag('icon/alert', array('title'=>__('home.pendingResult'))):''); ?></td>
		<td><?php echo link_to($eventDescription, '#goModule("event", "edit", "eventId", '.$eventObj->getId().')'); ?></td>
		<td align="right"><?php echo '#'.$eventPlayerObj->getEventPosition() ?></td>
		<td align="right"><?php echo Util::formatFloat($eventPlayerObj->getScore(), true, 3) ?></td>
		<td align="right"><?php echo Util::formatFloat($eventPlayerObj->getBuyin(), true) ?></td>
		<td align="right"><?php echo Util::formatFloat($eventPlayerObj->getRebuy(), true) ?></td>
		<td align="right"><?php echo Util::formatFloat($eventPlayerObj->getAddon(), true) ?></td>
		<td align="right"><?php echo Util::formatFloat($eventPlayerObj->getPrize(), true) ?></td>
	</tr>
<?php
	endforeach;
	if( empty($eventObjList) ):
?>
	<tr>
		<td colspan="7"><?php echo __('resume.noRealizedEvents') ?></td>
	</tr>
<?php endif; ?>
</table>