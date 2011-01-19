<table border="0" cellspacing="1" cellpadding="2" class="resumeEventTable">
	<tr>
		<th>Últimos eventos</th>
		<th class="icon"><?php echo image_tag('icon/positionGray', array('title'=>'Posição')) ?></th>
		<th class="icon"><?php echo image_tag('icon/scoreGray', array('title'=>'Pontos')) ?></th>
		<th class="icon"><?php echo image_tag('icon/buyinGray', array('title'=>'Buyin')) ?></th>
		<th class="icon"><?php echo image_tag('icon/rebuyGray', array('title'=>'Rebuy')) ?></th>
		<th class="icon"><?php echo image_tag('icon/addonGray', array('title'=>'Addon')) ?></th>
		<th class="icon"><?php echo image_tag('icon/prizeGray', array('title'=>'Ganhos')) ?></th>
	</tr>
<?php	
	foreach($eventObjList as $eventObj):
		
		$eventPlayerObj = EventPlayerPeer::retrieveByPK($eventObj->getId(), $peopleId);
		
		$eventDescription = $eventObj->getEventDate('d/m/Y').' '.$eventObj->getStartTime('H:i').' - <b>'.$eventObj->getEventName().'</b> @ '.$eventObj->getEventPlace().' ['.$eventObj->getRanking()->getRankingName().']';
		$eventDescription = truncate_text($eventDescription, 120);
?>
	<tr>
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
		<td>Nenhum evento realizado</td>
	</tr>
<?php endif; ?>
</table>