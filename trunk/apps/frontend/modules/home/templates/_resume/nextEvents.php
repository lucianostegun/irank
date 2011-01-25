<table border="0" cellspacing="1" cellpadding="2" class="resumeEventTable">
	<tr>
		<th><?php echo __('resume.nextEvents') ?></th>
	</tr>
<?php
	foreach($eventObjList as $eventObj):
		
		$eventDescription = $eventObj->getEventDate('d/m/Y').' '.$eventObj->getStartTime('H:i').' - <b>'.$eventObj->getEventName().'</b> @ '.$eventObj->getEventPlace().' ['.$eventObj->getRanking()->getRankingName().']';
		$eventDescription = truncate_text($eventDescription, 120);
?>
  <tr>
  	<td><?php echo link_to($eventDescription, '#goModule("event", "edit", "eventId", '.$eventObj->getId().')'); ?></td>
  </tr>
<?php
	endforeach;
	if( empty($eventObjList) ):
?>
  <tr>
  	<td><?php echo __('resume.noScheduledEvents') ?></td>
  </tr>
<?php endif; ?>
</table>