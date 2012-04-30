<table border="0" cellspacing="0" cellpadding="0" class="gridTable">
	<tr class="header">
		<th style="width: 55px" class="first">Posição</th>
		<th>Nome</th>
		<th style="width: 80px">Pontos</th>
		<th style="width: 80px">Eventos</th>
	</tr>
	<tbody>
<?php
	$criteria = new Criteria();
	$criteria->add( RankingLivePlayerPeer::TOTAL_EVENTS, 0, Criteria::GREATER_THAN );
	$eventLivePlayerObjList = $eventLiveObj->getEventLivePlayerResultList($criteria);
	
	$eventPosition = 0;
	
	foreach($eventLivePlayerObjList as $eventLivePlayerObj):
	
		$peopleObj = $eventLivePlayerObj->getPeople();
		
		$eventPosition++;
		$peopleId     = $peopleObj->getId();
		$peopleName   = $peopleObj->getFullName();
		$emailAddress = $peopleObj->getEmailAddress();
		$score        = $eventLivePlayerObj->getScore();
		$events       = $eventLivePlayerObj->getEvents();
?>
<tr class="<?php echo $class ?>">
	<td><?php echo $eventPosition ?>º</td> 
	<td><?php echo $peopleName ?></td>
	<td style="text-align: right"><?php echo Util::formatFloat($score, true, 3) ?></td>
	<td style="text-align: right"><?php echo Util::formatFloat($events) ?></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>