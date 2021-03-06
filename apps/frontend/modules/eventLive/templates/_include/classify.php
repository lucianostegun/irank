<?php
	$criteria = new Criteria();
	$criteria->add( RankingLivePlayerPeer::TOTAL_EVENTS, 0, Criteria::GREATER_THAN );
	$eventLivePlayerObjList = $eventLiveObj->getEventLivePlayerResultList($criteria);
	
	if( empty($eventLivePlayerObjList) ):
?>
	<div class="textC mt40"><h2>Os resultados deste evento ainda não foram lançados!</h2></div>
<?php else: ?>
<table border="0" cellspacing="0" cellpadding="0" class="gridTable">
	<tr class="header">
		<th style="width: 55px" class="first">Posição</th>
		<th>Nome</th>
		<th style="width: 80px">Pontos</th>
		<th style="width: 80px">Eventos</th>
	</tr>
	<tbody>
<?php
	$eventPosition   = 0;
	$peopleIdCurrent = $sf_user->getAttribute('peopleId');
	
	foreach($eventLivePlayerObjList as $eventLivePlayerObj):
	
		$peopleObj = $eventLivePlayerObj->getPeople();
		
		$eventPosition++;
		$peopleId     = $peopleObj->getId();
		$peopleName   = $peopleObj->getFullName();
		$emailAddress = $peopleObj->getEmailAddress();
		$score        = $eventLivePlayerObj->getScore();
		$events       = $eventLivePlayerObj->getEvents();
		
		$class = ($peopleIdCurrent==$peopleId?'itsMe':'');
?>
<tr class="<?php echo $class ?>">
	<td class="textR"><?php echo $eventPosition ?>º</td> 
	<td><?php echo $peopleName ?></td>
	<td class="textR"><?php echo Util::formatFloat($score, true, 3) ?></td>
	<td class="textR"><?php echo Util::formatFloat($events) ?></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
<?php endif; ?>