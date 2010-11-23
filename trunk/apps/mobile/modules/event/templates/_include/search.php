<?php
	$eventObjList = Event::getList($criteria);
  	
	foreach($eventObjList as $eventObj):
		$myEvent = $eventObj->isMyEvent();
?>
<tr class="boxcontent">
	<td><?php echo link_to($eventObj->getEventName(), '#goModule(\'event\', \'edit\', \'eventId\', '.$eventObj->getId().')').($myEvent?'*':'') ?></td>
	<td><?php echo $eventObj->getRanking()->getRankingName() ?></td>
	<td align="center"><?php echo $eventObj->getEventDate('d/m/Y').' '.$eventObj->getStartTime('H:i') ?></td>
</tr>
<?php
	endforeach;
  	
	if( count($eventObjList)==0 ):
?>
<tr class="boxcontent">
	<td colspan="6">Não existem eventos disponíveis para seus rankings</td>
</tr>
<?php endif; ?>