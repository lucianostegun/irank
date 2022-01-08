<?php
	$eventObjList = Event::getNextList();
?>
<table border="0" cellspacing="1" cellpadding="2" class="eventTable">
<?php
	foreach($eventObjList as $eventObj):
		
		$eventDescription = $eventObj->getEventDate('d/m/Y H:i').' - <b>'.$eventObj->getEventName().'</b> @ '.$eventObj->getEventPlace().' ['.$eventObj->getRanking()->getRankingName().']';
		$eventDescription = truncate_text($eventDescription, 90);
?>
  <tr>
  	<td class="nextEvent"><?php echo link_to($eventDescription, '#goModule("event", "edit", "eventId", '.$eventObj->getId().')'); ?></td>
  </tr>
<?php endforeach; ?>

  <tr>
  	<td style="padding: 15 0 3 0; border-bottom: 1px solid #333333; font-weight: bold; color: #666666">Últimos eventos</td>
  </tr>
  
<?php	
	$eventObjList = Event::getList(null, 4);
	foreach($eventObjList as $eventObj):
		
		$eventDescription = $eventObj->getEventDate('d/m/Y H:i').' - <b>'.$eventObj->getEventName().'</b> @ '.$eventObj->getEventPlace().' ['.$eventObj->getRanking()->getRankingName().']';
		$eventDescription = truncate_text($eventDescription, 90);
?>
  <tr>
  	<td class="lastEvent"><?php echo link_to($eventDescription, '#goModule("event", "edit", "eventId", '.$eventObj->getId().')'); ?></td>
  </tr>
<?php
	endforeach;
?>
</table>
